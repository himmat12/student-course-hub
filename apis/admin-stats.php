<?php

// api to get list all admin page statistics (total programmes, total staffs, total modules and so on)

require_once '../config.php';
include './db_connect.php';

// constant variables for consistemcy
$USER_TYPE = 'admin';

// db connection
$pdo = createDbConnection($USER_TYPE);

// checking connection, if failed returning this info
if (!$pdo) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Database connection failed']);
}


try {
    // prepering and executing programmes SQL query 
    $programmeSql = "SELECT programmes.LevelID AS LevelID FROM programmes;";
    $programmeStmt = $pdo->prepare($programmeSql);
    $programmeStmt->execute();

    // fetching the list of modules id list
    $programmes = $programmeStmt->fetchAll();

    // prepering and executing programmes SQL query 
    $moduleSql = "SELECT
    levels.LevelID AS LevelID
FROM
    levels
INNER JOIN programmes ON levels.LevelID = programmes.LevelID
INNER JOIN programmemodules ON programmemodules.ProgrammeID = programmes.ProgrammeID;";
    $moduleStmt = $pdo->prepare($moduleSql);
    $moduleStmt->execute();

    // fetching the list of modules level id list
    $modules = $moduleStmt->fetchAll();

    // prepering and executing staffs SQL query 
    $staffSql = "SELECT staff.Position AS Position FROM staff;";
    $staffStmt = $pdo->prepare($staffSql);
    $staffStmt->execute();

    // fetching the list of staffs position list
    $staffs = $staffStmt->fetchAll();

    // prepering and executing interested students SQL query 
    $studentSql = "SELECT COUNT(interestedstudents.Email) AS Total FROM interestedstudents;";
    $studentStmt = $pdo->prepare($studentSql);
    $studentStmt->execute();

    // fetching the total count of interested students list
    $studentsCount = $studentStmt->fetch();

    // final result which is associative array of all combined results from all sql statements (programmes)
    $totalProgrammes = count($programmes);
    $totalUGProgrammes = 0;
    $totalPGProgrammes = 0;

    // counting total UG and PG programmes list
    foreach ($programmes as $programme) {
        if ($programme['LevelID'] == 1) {
            $totalUGProgrammes++;
        }
        if ($programme['LevelID'] == 2) {
            $totalPGProgrammes++;
        }
    }

    // final result which is associative array of all combined results from all sql statements (modules)
    $totalModules = count($modules);
    $totalUGModules = 0;
    $totalPGModules = 0;

    // counting total UG and PG programmes list
    foreach ($modules as $module) {
        if ($module['LevelID'] == 1) {
            $totalPGModules++;
        }
        if ($module['LevelID'] == 2) {
            $totalUGModules++;
        }
    }

    // final result which is associative array of all combined results from all sql statements (staffs)
    $totalStaffs = count($staffs);
    $totalSeinorProf = 0;
    $totalProfessors = 0;
    $totalAssistProf = 0;
    $totalAssocProf = 0;

    // counting total UG and PG programmes list
    foreach ($staffs as $staff) {
        if ($staff['Position'] == 'Senior Lecturer') {
            $totalSeinorProf++;
        }
        if ($staff['Position'] == 'Professor') {
            $totalProfessors++;
        }
        if ($staff['Position'] == 'Associate Professor') {
            $totalAssocProf++;
        }
        if ($staff['Position'] == 'Assistant Professor') {
            $totalAssistProf++;
        }
    }

    $stats = [
        "Programmes" =>  [
            "Total" => $totalProgrammes,
            "TotalPG" => $totalPGProgrammes,
            "TotalUG" => $totalUGProgrammes
        ],
        "Modules" =>   [
            "Total" => $totalModules,
            "TotalPG" => $totalPGModules,
            "TotalUG" => $totalUGModules
        ],
        "Staffs" =>   [
            "Total" => $totalStaffs,
            "TotalSeinorProf" => $totalSeinorProf,
            "TotalProf" => $totalProfessors,
            "TotalAssocProf" => $totalAssocProf,
            "TotalAssistProf" => $totalAssistProf
        ],
        "Students" => $studentsCount
    ];

    // returning the results as JSON
    header('Content-Type: application/json');
    echo json_encode(['data' => $stats]);
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
