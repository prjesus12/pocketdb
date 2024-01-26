
# Pocketdb

A extensible php mini framework inspired on pocketbase.


## Features

- Sqlite integration
- Easy api use
- Make it yours
- Cross platform
- Docker mini configuration


## Installation

Create an .env file with this:

```bash
ACCESS_TOKEN={anykey}
DB_NAME=database.sqlite
```

## Guide

Make sure that you have composer installed before using
```bash
composer install
```

Each time that you create a controller or config folders you should run this:
```bash
composer dump-autoload
```

    
## Routes

-  Create Table
    ```bash
    http://localhost:8000/index.php?_c=DatabaseController&_a=createTable
    ```
-  Drop Table
    ```bash
    http://localhost:8000/index.php?_c=DatabaseController&_a=dropTable
    ```
-  Query SELECT
    ```bash
    http://localhost:8000/index.php?_c=QueryController&_a=select
    ```
-  More coming soon....
    