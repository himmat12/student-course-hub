<?php

use function PHPSTORM_META\type;

require_once '../config.php';
include './db_connect.php';


//  helper function to generate response JSON
function sendResponse($statusCode, $data)
{
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

//  helper function to verify the encrypted password retrived from db
function verifyPassword($inputPassword, $storedPassword)
{
    // hashing our pasword input value in 'sha256' hashing algorithm and storing the hash value
    $hashedInput = hash('sha256', $inputPassword);
    // comparing the hash value (password stored in db) from database and user input and returning true/false based on the comparision
    return hash_equals($storedPassword, $hashedInput);
}

// get POST data (JSON) from input stream (making our api versatile to be accessed outside of html like postman for testing or other platforms like mobile applications)
$data = json_decode(file_get_contents('php://input'), true);

// if data is null (not valid JSON), try to use $_POST
if ($data === null) {
    $data = $_POST;
}

// validating user credentials if missing
if (!isset($data['username']) || !isset($data['password']) || !isset($data['usertype'])) {
    sendResponse(400, ['message' => 'Missing credentials']);
}

// cleaning our input data from api body
$username = htmlspecialchars(trim($data['username']));
$userType = htmlspecialchars(trim($data['usertype']));



// creating database connection
$pdo = createDbConnection($userType);

// echo json_encode(["usertype" => $userType, "pdo" => $pdo]);

// validating connection
if (!$pdo) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Database connection failed']);
    exit;
}

try {

    $sql = "SELECT
    u.UserID AS UserID,
    u.Username AS Username,
    u.Password AS Password,
    u.StaffID AS StaffID,
    u.UserType AS UserType,
    u.LastLogin AS LastLogin,
    u.CreatedAt AS CreatedAt
FROM
    users AS u
WHERE
    u.Username = :username;";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':username', $username);

    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        sendResponse(401, ['message' => 'Invalid credentials']);
    }

    $user = $stmt->fetch();

    // verifying password
    if (!verifyPassword($data['password'], $user['Password'])) {
        sendResponse(401, ['message' => 'Invalid password']);
    }

    // Update last login time
    $updateSql = "UPDATE users SET users.LastLogin = NOW() WHERE users.UserID =:userID;";

    $updateStmt = $pdo->prepare($updateSql);

    $updateStmt->bindParam(':userID', $user['UserID']);

    $updateStmt->execute();

    // for production only - testing user response data
    // echo json_encode(["user" => $user]);

    sendResponse(200, [
        'message' => 'Login successful',
        'data' => [
            'UserID' => $user['UserID'],
            'Username' => $user['Username'],
            'UserType' => $user['UserType'],
            'StaffID' => $user['StaffID'],
            'LastLogin' => $user['LastLogin'],
            'CreatedAt' => $user['CreatedAt']
        ]
    ]);
} catch (PDOException $e) {
    // logging the error in production environment
    error_log("Authuntication failed: " . $e->getMessage());

    // returning error response
    // header('HTTP/1.1 500 Internal Server Error');
    sendResponse(500, ['message' => 'Login failed', 'error' => $e->getMessage()]);
} finally {
    // closing the database connection by setting pdo value to null
    $pdo = null;
}
