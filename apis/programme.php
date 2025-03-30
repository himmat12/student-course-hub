<?php

// api to get programme description 

require_once '../config.php';
include './db_connect.php';

// db connection
$pdo = createDbConnection();

// query parameters 
$programID = isset($_GET['id']) ? $_GET['id'] : null;

// checking connection, if failed returning this info
if (!$pdo) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Database connection failed']);
}


try {
    // prepering SQL query
    $sql = "SELECT
    p.ProgrammeID AS ProgramId,
    p.ProgrammeName AS ProgramName,
    p.Image AS ImgUrl,
    l.LevelName AS 'Level',
    s.Name AS ProgramLeader,
    p.Description AS Description
    FROM
    programmes AS p
    INNER JOIN levels AS l
    ON
    p.LevelID = l.LevelID
    INNER JOIN staff AS s
    ON
    p.ProgrammeLeaderID = s.StaffID
    WHERE
    p.ProgrammeID = :programID;";

    $stmt = $pdo->prepare($sql);

    // binding our program id parameter with the sql statement
    $stmt->bindParam(":programID", $programID, PDO::PARAM_INT);

    // executing query
    $stmt->execute();

    $programmes = $stmt->fetchAll();

    // returning the results as JSON
    header('Content-Type: application/json');
    echo json_encode(['data' => $programmes[0]]);
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
