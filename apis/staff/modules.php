<?php

// api to get list of programmes for admin dashboard (it can take query as search parameter and list filetred lists based on the query parameter)

require_once '../../config.php';
include '../db_connect.php';

// db connection
$pdo = createDbConnection();

// query parameters 
$id = isset($_GET['id']) ? $_GET['id'] : null;

// checking connection, if failed returning this info
if (!$pdo) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Database connection failed']);
}

try {
    // prepering SQL query
    $sql = "SELECT 
    m.ModuleID,
    m.ModuleName,
    m.Description,
    p.ProgrammeName AS AssociatedProgramme,
    pm.Year AS ProgrammeYear
FROM 
    modules m
JOIN programmemodules pm ON m.ModuleID = pm.ModuleID
JOIN programmes p ON pm.ProgrammeID = p.ProgrammeID
WHERE 
    m.ModuleLeaderID = (SELECT StaffID FROM users WHERE UserID = :id) GROUP BY m.ModuleID;";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(":id" => $id));

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
