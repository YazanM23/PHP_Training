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
 if($_SERVER['REQUEST_METHOD']=='PATCH'){
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'];
    $firstName = $data['FirstName'];
    $lastName = $data['LastName'];
    $email = $data['Email'];
    $length = $data['Length'];
    $weight = $data['Weight'];
    $team = $data['Team'];

    $sql = "UPDATE Players SET 
                FirstName = '$firstName', 
                LastName = '$lastName', 
                Email = '$email', 
                Length = $length, 
                Weight = $weight,
                Team = '$team'
                WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Player updated successfully.']);
    } else {
        echo json_encode(['message' => 'Error: ' . $conn->error]);
    }

}
