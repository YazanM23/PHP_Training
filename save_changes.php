<?php
$conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['update'])) {

    $username = $_POST['update'];
    $key = array_search($username, $_POST['PlayerUsername']);

    $firstName = $_POST['FirstName'][$key];
    $lastName = $_POST['LastName'][$key];
    $email = $_POST['Email'][$key];
    $length = $_POST['Length'][$key];
    $weight = $_POST['Weight'][$key];
    $team = $_POST['Team'][$key];

    // Update the player in the database
    $sqlUpdate = "UPDATE Players SET 
                    FirstName = '$firstName', 
                    LastName = '$lastName', 
                    Email = '$email', 
                    Length = '$length', 
                    Weight = '$weight', 
                    Team = '$team' 
                  WHERE username = '$username'";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_POST['insert'])) {
    // Assuming you have the player details in arrays
    $playerUsername = $_POST['PlayerUsername'][count($_POST['PlayerUsername']) - 1]; // Last entered
    $firstName = $_POST['FirstName'][count($_POST['FirstName']) - 1];
    $lastName = $_POST['LastName'][count($_POST['LastName']) - 1];
    $email = $_POST['Email'][count($_POST['Email']) - 1];
    $length = $_POST['Length'][count($_POST['Length']) - 1];
    $weight = $_POST['Weight'][count($_POST['Weight']) - 1];
    $team = $_POST['Team'][count($_POST['Team']) - 1];
    $password = $_POST['Password'][count($_POST['Password']) - 1];
    // Insert into the database
    $sql = "INSERT INTO Players (username, FirstName, LastName, Email, Length, Weight, Team,Password) VALUES ('$playerUsername', '$firstName', '$lastName', '$email', $length, $weight, '$team','$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New player added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (isset($_POST['delete'])) {
    $username = $_POST['delete'];


    $sqlDelete = "DELETE FROM Players WHERE username = '$username'";

    if ($conn->query($sqlDelete) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
header("Location: table.php");
exit();
?>
