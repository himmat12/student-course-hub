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
    p.ProgrammeID,
    p.ProgrammeName,
    p.Description,
    p.LevelID,
    p.Status,
    CASE 
        WHEN p.ProgrammeLeaderID = (SELECT StaffID FROM users WHERE UserID = :id1) 
        THEN 'Programme Leader' 
        ELSE 'Module Leader' 
    END AS AssignmentType
FROM 
    programmes p
LEFT JOIN programmemodules pm ON p.ProgrammeID = pm.ProgrammeID
LEFT JOIN modules m ON pm.ModuleID = m.ModuleID
WHERE 
    p.ProgrammeLeaderID = (SELECT StaffID FROM users WHERE UserID = :id2)
    OR m.ModuleLeaderID = (SELECT StaffID FROM users WHERE UserID = :id3) GROUP BY p.ProgrammeID;";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(":id1" => $id, ":id2" => $id, ":id3" => $id));

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
