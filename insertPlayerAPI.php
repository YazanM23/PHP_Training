<?php
// Set the header to return JSON
header('Content-Type: application/json');

// Allow CORS for testing purposes (you might want to remove this in production)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Database connection
$conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

// Get the input data
$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
