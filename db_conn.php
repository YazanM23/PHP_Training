<?php
$conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}
?>