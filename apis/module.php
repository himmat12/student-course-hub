<?php

// api to get module description 

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
    modules.ModuleID AS ModuleId,
    modules.ModuleName AS ModuleName,
    modules.Description AS Description,
    modules.Image AS ImgUrl,
    staff.Name AS ModuleLeader
FROM
    modules
INNER JOIN staff ON modules.ModuleLeaderID = staff.StaffID
WHERE
    modules.ModuleID = :moduleID;";

    $stmt = $pdo->prepare($sql);

    // binding our program id parameter with the sql statement
    $stmt->bindParam(":moduleID", $moduleID, PDO::PARAM_INT);

    // executing query
    $stmt->execute();

    $module = $stmt->fetchAll();

    // returning the results as JSON
    header('Content-Type: application/json');
    echo json_encode(['data' => $module[0]]);
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
