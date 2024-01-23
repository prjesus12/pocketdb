<?php
namespace Config;

class Jwt {
    private $header = ['alg' => 'HS256', 'typ' => 'JWT'];
    private $payload = [];
    private $secret;

    public function __construct($secret) {
        $this->secret = $secret;
    }

    private function withHeader(array $header) {
        $this->header = $header;
        return $this;
    }

    public function withPayload(array $payload) {
        $this->payload['data'] = $payload;
        return $this;
    }
    public function withExpirationTime($time) {
        $this->payload['exp'] = time() + $time;
        return $this;
    }

    public function encode() {
        $header = rtrim(strtr(base64_encode(json_encode($this->header)), '+/', '-_'), '=');
        $payload = rtrim(strtr(base64_encode(json_encode($this->payload)), '+/', '-_'), '=');
        $signature = $this->generateSignature($header, $payload);

        return $header . '.' . $payload . '.' . $signature;
    }

    private function generateSignature($header, $payload) {
        $dataToSign = $header . '.' . $payload;
        return rtrim(strtr(base64_encode(hash_hmac('sha256', $dataToSign, $this->secret, true)), '+/', '-_'), '=');
    }

    public function verify($token) {
        list($headerBase64, $payloadBase64, $signature) = explode('.', $token);

        $header = json_decode(base64_decode(rtrim(strtr($headerBase64, '-_', '+/'), '=')), true);
        $payload = json_decode(base64_decode(rtrim(strtr($payloadBase64, '-_', '+/'), '=')), true);

        if ($this->verifySignature($headerBase64, $payloadBase64, $signature)) {

            $this->verifyExpirationTime($payload);

            return $payload['data'];
        }

        // Signature verification failed
        return null;
    }

    private function verifyExpirationTime($payload) {
        if(isset($payload['exp'])){
            if($payload['exp'] < time()){
                die("Expired Token");
            }
        }
    }

    private function verifySignature($headerBase64, $payloadBase64, $signature) {
        $expectedSignature = rtrim(strtr(base64_encode(hash_hmac('sha256', $headerBase64 . '.' . $payloadBase64, $this->secret, true)), '+/', '-_'), '=');
        return hash_equals($expectedSignature, $signature);
    }
}
