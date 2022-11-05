<?php

class DBController
{
    private $host = "sql444.main-hosting.eu";
    private $user = "u928796707_group34";
    private $password = "u1VF3KYO1r|";
    private $database = "u928796707_internshipWeb";

    function __construct()
    {
        $this->conn = $this->connectDB();
    }

    private function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("Connect failed: %s\n" . $conn->error);
        return $conn;
    }

    function runQuery($query)
    {
        $result =  mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset;
    }

    function numRows($query)
    {
        $result  = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

    function executeQuery($query)
    {
        $result  = mysqli_query($this->conn, $query);
        return $result;
    }
}
