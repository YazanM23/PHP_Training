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
if($_SERVER['REQUEST_METHOD']=='GET'){
    $query = "SELECT username, FirstName, LastName, Email, Length, Weight, Team FROM Players WHERE Team=(SELECT Team FROM Trainer WHERE username='$username')";
    $result = $conn->query($query);

    $players = [];


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $players[] = $row;

        }
    }


    echo json_encode($players);

    $conn->close();
}

else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (
        isset($data['PlayerUsername'], $data['FirstName'], $data['LastName'], $data['Email'],
            $data['Length'], $data['Weight'], $data['Password'])
    ) {
        // Get form values
        $username = $data['PlayerUsername'];
        $firstName = $data['FirstName'];
        $lastName = $data['LastName'];
        $email = $data['Email'];
        $length = $data['Length'];
        $weight = $data['Weight'];
        $password = $data['Password']; // Hash the password

        // Prepare and bind the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO Players (username, FirstName, LastName, Email, Length, Weight, Password,Team) VALUES (?, ?, ?, ?, ?, ?, ?,'Barcelona')");
        $stmt->bind_param("ssssdds", $username, $firstName, $lastName, $email, $length, $weight, $password);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['message' => 'New player added successfully']);
        } else {
            echo json_encode(['error' => 'Error: ' . $stmt->error]);
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['error' => 'Invalid input']);
    }
}


else {
    echo json_encode(['error' => 'Invalid request method']);
}

?>
