<?php

// api to get list of programmes which shares the specified module based on module id

require_once '../config.php';
include './db_connect.php';

// db connection
$pdo = createDbConnection();

// query parameters 
$moduleID = isset($_GET['id']) ? $_GET['id'] : null;

// checking connection, if failed returning this info
if (!$pdo) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Database connection failed']);
}


try {
    // prepering SQL query
    $sql = "SELECT
    modules.ModuleID AS ModuleID,
    modules.ModuleName AS ModuleName,
    programmes.ProgrammeID AS ProgrammeID,
    programmes.ProgrammeName AS ProgramName,
    programmes.Description AS Description,
    programmes.Image AS ImgUrl,
    staff.Name AS ProgramLeader
FROM
    programmes
INNER JOIN staff ON programmes.ProgrammeLeaderID = staff.StaffID
INNER JOIN programmemodules ON programmemodules.ProgrammeID = programmes.ProgrammeID
INNER JOIN modules ON programmemodules.ModuleID = modules.ModuleID
WHERE
    programmemodules.ModuleID = :moduleID;";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":moduleID", $moduleID, PDO::PARAM_INT);

    // executing query
    $stmt->execute();

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
