
# Pocketdb

A extensible php mini framework inspired on pocketbase.


## Features

- Sqlite integration
- Easy api use
- Extendible on controllers
- Cross platform


## Installation

Create an .env file with this:

```bash
ACCESS_TOKEN={anykey}
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
    