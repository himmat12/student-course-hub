<?php
// api to delete programmes for admin

require_once '../../config.php';
include '../db_connect.php';


// database connection
$pdo = createDbConnection('admin');

// validating connection
if (!$pdo) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Database connection failed']);
    exit;
}

// validating to only process POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Method not allowed']);
    exit;
}

// get POST data (JSON) from input stream (making our api versatile to be accessed outside of html like postman for testing or other platforms like mobile applications)
$data = json_decode(file_get_contents('php://input'), true);

// if data is null (not valid JSON), try to use $_POST
if ($data === null) {
    $data = $_POST;
}

// validating required fields
$requiredFields = ['ProgrammeID'];
$missingFields = [];

foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: application/json');
    echo json_encode([
        'message' => 'Missing required fields',
        'fields' => $missingFields
    ]);
    exit;
}

// cleaning input data 
$programmeID = htmlspecialchars(trim($data['ProgrammeID']));


try {
    $sql = "DELETE FROM programmes WHERE programmes.ProgrammeID = :ProgrammeID;";

    $stmt = $pdo->prepare($sql);

    // binding parameters
    $stmt->bindParam(':ProgrammeID', $programmeID, PDO::PARAM_INT);

    $success = $stmt->execute();

    if ($success) {
        // returning success response along with submitted form data
        header('HTTP/1.1 201 Created');
        header('Content-Type: application/json');
        echo json_encode([
            'message' => 'Programme deleted successfully',
            'data' => $data
        ]);
    } else {
        throw new PDOException("Failed to insert record");
    }
} catch (PDOException $e) {
    // logging the error in production environment
    error_log("Interest registration failed: " . $e->getMessage());

    // returning error response
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode([
        'message' => 'Registration failed',
        'error' => $e->getMessage()
    ]);
} finally {
    // closing the database connection by setting pdo value to null
    $pdo = null;
}
