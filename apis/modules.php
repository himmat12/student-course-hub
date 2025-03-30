<?php

// api to get list of modules in program

require_once '../config.php';
include './db_connect.php';

// db connection
$pdo = createDbConnection();

// query parameters 
$programId = isset($_GET['id']) ? $_GET['id'] : null;

// checking connection, if failed returning this info
if (!$pdo) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Database connection failed']);
}


try {
    // prepering SQL query
    $sql = "SELECT
    programmemodules.ProgrammeModuleID AS ProgramModuleId,
    programmemodules.ProgrammeID AS ProgramId,
    modules.ModuleID AS ModuleId,
    modules.ModuleName AS ModuleName,
    modules.Description AS Description,
    modules.Image AS ImgUrl,
    programmemodules.Year AS 'Year'
FROM
    modules
INNER JOIN programmemodules ON modules.ModuleID = programmemodules.ModuleID
WHERE
    programmemodules.ProgrammeID = :programID;";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":programID", $programId, PDO::PARAM_INT);

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
