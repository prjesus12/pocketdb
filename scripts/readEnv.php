<?php
// Specify the path to your .env file
$envFilePath = '.env';

// Check if the file exists
if (file_exists($envFilePath)) {
    // Read the file into an array, each line becomes an element in the array
    $envFileContent = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Iterate through each line and parse the key-value pairs
    foreach ($envFileContent as $line) {
        // Split the line into key and value
        list($key, $value) = explode('=', $line, 2);

        // Trim whitespace from key and value
        $key = trim($key);
        $value = trim($value);

        $_ENV[$key] = $value;
    }
} else {
    die("Please make an .env file");
}

