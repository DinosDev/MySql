# MySql
Classes you can modify your MySql database even if you don't know SQL.

[View on Packagist](https://packagist.org/packages/dinodev/my-sql)

## How to Use
* Install PHP
* Install MySql. 
* Run the Command `composer require dinodev/my-sql`

### Connecting With Database
```php
use DinoDev\MySql\Classes\MySql;

//Creating MySql
$MySql = new MySql(
    "localhost" /* Hostname */,
    "root"      /* Username */,
    "MySql"     /* Password */,
    "world"     /* Database */,
    $state      /* State of MySql Connect (Success or Error) */
);
```

### Features
With MySql Library, you can run the following SQL commands: 
* Create
* Drop
* Select
* Delete
* Insert

All theses Features are Classes, with namespace `DinoDev\MySql\Classes\`

#### Create
How to Use:
```php
$Create = new Create(
    $MySql /* Here, you pass the MySql Object */
);

//Create Table
$Create->Table(
    "TableName"                    /* The Table Name*/,
    ["Value 1", "Value2"]          /* The Name Of Values */,
    ["varchar(20)", "varchar(50)"] /* The Type Of Values*/
);
```

#### Drop
How to Use:
```php
$Drop = new Drop(
    $MySql /* Here, you pass the MySql Object */
);

//Drop Table
$Drop->Table(
    "TableName" /* The Table Name */
);
```

#### Select
How to Use:
```php
$Select = new Select(
    $MySql /* Here, you pass the MySql Object*/
);

//Select All
$Select->All(
    "TableName" /* The Table Name */,
    5           /* The Limit of Rows (Optional) */
);

//Select Where
$Select->Where(
    "TableName" /* The Table Name */,
    "Field",    /* The Field Name */
    "Value",    /* Value */
    5           /* The Limit of Rows (Optional) */
);

//Select Like
$Select->Like(
    "TableName" /* The Table Name */,
    "Field",    /* The Field Name */
    "Value",    /* Value */
    5           /* The Limit of Rows (Optional) */
);
```

#### Insert
How to Use:
```php
$Insert = new Insert(
    $MySql /* Here, you pass the MySql Object*/
);

//Insert
$Insert->Insert(
    "TableName"                  /* The Table Name */,
    [ "Field One", "Field Two" ] /* The Fields Name */ ,
    [ "Value One", "Value Two" ] /* Values */
);
```

#### Delete
How to Use:
```php
//Delete Where
$Delete->Where(
    "TableName" /* The Table Name */,
    "Field"     /* The Field Name */,
    "Value",    /* Value */
);

//Delete Like
$Delete->Like(
    "TableName" /* The Table Name */,
    "Field",    /* The Field Name */
    "Value",    /* Value */
);
```



## Example
```php
<?php

use DinoDev\MySql\Classes\{
    MySql,
    Create,
    Drop,
    Select,
    Insert,
    Delete
};

require_once __DIR__ . "/vendor/autoload.php";

//Creating MySql
$MySql = new MySql(
    "localhost",
    "root",
    "MySql",
    "world",
    $state
);

$Create = new Create($MySql);

$Drop = new Drop($MySql);
$Select = new Select($MySql);

$Insert = new Insert($MySql);

$Delete = new Delete($MySql);

//Creating Table
$Create->Table(
    "Users",
    ["Name",         "Mail",         "Pwd",          "Age"],
    ["varchar(20)",  "varchar(50)",  "varchar(70)",  "tinyint"]
); //Return True

//Insert 2 Users
insertUsers($Insert);

//Delete All Users
$Delete->All("Users"); //Return True

//Insert 2 Users
insertUsers($Insert);

$Delete->Where(
    "Users",
    "Age",
    32
); //Return True

$Delete->Like(
    "Users",
    "Name",
    "Mich"
); //Return True

//Insert 2 Users
insertUsers($Insert);

$Select->All("Users"); //Return All Users
$Select->All("Users", 1); //Return Joe User (Limit 1)

$Select->Where(
    "Users",
    "Age",
    32
); //Return Joe User
$Select->Like(
    "Users",
    "Name",
    "Mich"
); //Return Michael User

//Drop The Table Users
$Drop->Table("Users"); //Return True 


function insertUsers(Insert $Insert)
{
    //Insert Joe User
    $Insert->Insert(
        "Users",
        ["Name", "Mail",            "Pwd",    "Age"],
        ["Joe",  "Joe@Website.com", "Joe123", 32]
    ); //Return True

    //Insert Michael User
    $Insert->Insert(
        "Users",
        ["Name",     "Mail",              "Pwd",    "Age"],
        ["Michael",  "Michael@gmail.com", "leahciM", 19]
    ); //Return True
}

```
