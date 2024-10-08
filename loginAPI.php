<?php
session_start();

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PATCH, DELETE");
header("Access-Control-Allow-Headers: Content-Type");


require 'db_conn.php';
global $conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'];
    $password = $data['password'];

    $sqlPlayer = "SELECT username FROM Players WHERE username = '$username' AND Password = '$password'";
    $sqlTrainer = "SELECT username FROM Trainer WHERE username = '$username' AND Password = '$password'";

    $fetchPlayer = $conn->query($sqlPlayer);
    $fetchTrainer = $conn->query($sqlTrainer);

    if ($fetchPlayer && $fetchPlayer->num_rows > 0) {
        $playerRow = $fetchPlayer->fetch_assoc();
        $_SESSION['name'] = $playerRow['username'];
        echo json_encode(['status' => 'success', 'redirect' => 'player.php']);
    } elseif ($fetchTrainer && $fetchTrainer->num_rows > 0) {
        $trainerRow = $fetchTrainer->fetch_assoc();
        $_SESSION['name'] = $trainerRow['username'];
        echo json_encode(['status' => 'success', 'redirect' => 'trainer.php']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
    }
    exit();
}
