<?php

// api to get list of programmes (it can take query as search parameter and list filetred lists based on the query parameter)

require_once '../config.php';
include './db_connect.php';

// db connection
$pdo = createDbConnection();

// query parameters 
$query = isset($_GET['query']) ? $_GET['query'] : '';
$level = isset($_GET['level']) ? $_GET['level'] : null;

// checking connection, if failed returning this info
if (!$pdo) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Database connection failed']);
}


try {
    // prepering SQL query
    $sql = "SELECT * FROM programmes WHERE ProgrammeName LIKE :query  AND Status = 1  ORDER BY ProgrammeID DESC;";

    $stmt = $pdo->prepare($sql);

    // adding wildcard for LIKE
    $searchParam = "%" . $query . "%";
    $stmt->bindParam(":query", $searchParam, PDO::PARAM_STR);

    // executing query
    $stmt->execute();

    // if the level parameter is provided in then setting our SQL query to filter based on program level
    if ($level != null) {
        $sql = "SELECT * FROM programmes WHERE ProgrammeName LIKE :query AND LevelID = :levelID AND Status = 1 ORDER BY ProgrammeID DESC";

        $stmt = $pdo->prepare($sql);
        // $stmt->bindParam(":levelID", $level, PDO::PARAM_INT);

        // executing query
        $stmt->execute(array(":query" => $searchParam, ":levelID" => $level));
    }

    // just for filter feature by level

    $programmes = $stmt->fetchAll();

    // returning the results as JSON
    header('Content-Type: application/json');
    echo json_encode(['data' => $programmes]);
} catch (PDOException $e) {
    //  logging the error in production env
    error_log("Search query failed: " . $e->getMessage());

    // returning error response
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Database query failed', "log" => $e->getMessage()]);
} finally {
    //  closing the database connection by setting it to null
    $pdo = null;
}
