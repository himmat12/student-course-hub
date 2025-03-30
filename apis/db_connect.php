<?php

require_once BASE_PATH . '/config.php';

// function to connect database
function createDbConnection($userType = null)
{

    // setting default user to 'web_app' if the user type is not passed through function parameter or is null
    if (!$userType) {
        $userType = 'web_app';
    }

    // accessing the environment variable to access db credentials
    $config = parse_ini_file(BASE_PATH . '/config.ini', true);

    // validating if the user type does not exists the setting it to 'web_app' by default
    if (!isset($config[$userType])) {
        $userType = 'web_app';
    }


    // mapping the env credentials to respective fields for dns string
    $host = $config[$userType]['host'];
    $dbname = $config[$userType]['dbname'];
    $username = $config[$userType]['username'];
    $password = $config[$userType]['password'];
    $charset = 'utf8mb4';

    $dns = "mysql:host={$host};dbname={$dbname};charset={$charset}";

    //  for production only - testing the db user credentials
    // echo json_encode([
    //     "usertype" => $userType,
    //     "host" => $host,
    //     "dbname" => $dbname,
    //     "username" => $username,
    //     "password" => $password
    // ]);

    try {
        $pdo = new PDO(
            $dns,
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // setting PDO error mode to exception
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // setting default PDO fetch mode to fetach associative array
                PDO::ATTR_EMULATE_PREPARES => false // implements PDO to use real prepared statements 
            ]
        );

        return $pdo;
    } catch (PDOException $e) {
        // logging the error in production environment
        error_log("Database connection failed: " . $e->getMessage());

        echo json_encode([
            "message" => "Database connection failed",
            "error" => $e->getMessage()
        ]);

        // returning false to indicate connection failure
        return false;
    }
}
