<?php

namespace DinoDev\MySql\Classes;

class MySql
{
    private string $hostname;
    private string $username;
    private string $password;
    private string $database;

    protected \mysqli $mysqli;

    function __construct(
        string $_hostname,
        string $_username,
        string $_password,
        string $_database,
        &$state
    ) {
        $this->hostname = $_hostname;
        $this->username = $_username;
        $this->password = $_password;
        $this->database = $_database;
        $this->hostname = $_hostname;

        $this->mysqli = @new \mysqli($_hostname, $_username, $_password, $_database);

        $connectDatabaseErrorMessage = "Fail to Connect with Database. " . $this->mysqli->connect_error;

        $state = ($this->mysqli->connect_errno)
            ? $connectDatabaseErrorMessage
            : true;
    }

    public function query(string $query)
    {
        return $this->mysqli->query($query, MYSQLI_USE_RESULT);
    }

    public function queryAndFetch(string $query)
    {
        $queryResult = $this->query($query);
        if(gettype($queryResult) === "boolean") return $queryResult;
        
        $fetch = $queryResult->fetch_all(MYSQLI_ASSOC);

        return $fetch;
    }

    protected function getAffectedRows()
    {
        return $this->mysqli->affected_rows;
    }
}
