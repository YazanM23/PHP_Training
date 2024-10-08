<?php
session_start();


header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PATCH, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

file_put_contents('debug.log', "Accessed tableAPI.php\n", FILE_APPEND);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username=$_SESSION['name'];

require 'db_conn.php';
global $conn;
if($_SERVER['REQUEST_METHOD']=='DELETE'){
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['username'])) {
        $username = $data['username'];

        $sqlDelete = "DELETE FROM Players WHERE username = '$username'";

        if ($conn->query($sqlDelete) === TRUE) {
            echo json_encode(['message' => 'Record deleted successfully']);
        } else {
            echo json_encode(['error' => 'Error deleting record: ' . $conn->error]);
        }
    } else {
        echo json_encode(['error' => 'No username provided']);
    }
}

else {
    echo json_encode(['error' => 'Invalid request method']);
}

?>
