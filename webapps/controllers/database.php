<?php

function dbConnect()
{      
    $dbhost=DB_HOST;
    $dbname=DB_NAME;
    $charset=CHARSET;
    $dsn = "mysql:host=$dbhost;dbname=$dbname;$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        return $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

function mySQLConnect()
{
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            // If there is an error with the connection, stop the script and display the error.
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    return $con;
}

function logger($activity, $sqlquery, $pdo)
{
    if (LOGGING=='enabled'){
        $strquery = str_replace(array('\'', '"'), '', $sqlquery);
        $insert = "INSERT INTO logger ( function, query ) VALUES ('".$activity."','".$strquery."')";
        $pdo->query($insert);
    }
}

?>