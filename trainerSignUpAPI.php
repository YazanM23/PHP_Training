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
    print_r($data,true);
    $username=$data['user'];
    $fname=$data['fname'];
    $lname=$data['lname'];
    $email=$data['email'];
    $password=$data['password'];
    $team=$data['team'];



    $sql="SELECT username FROM Players WHERE username = '$username' UNION SELECT username FROM Trainer WHERE username = '$username'";

    $flag=false;
    $fetch=$conn->query($sql);


    if($fetch){
        if($fetch->num_rows>0){
            $flag=true;
        }

    }

    if(!$flag){
        $sql = "INSERT INTO Trainer (username, FirstName, LastName, Email, Password, Team) 
        VALUES ('$username', '$fname', '$lname', '$email', '$password', '$team')";
        try{

            $conn->query($sql);
            echo json_encode(['status' => 'success', 'redirect' => 'signin.php']);

            exit();
        }
        catch (Exception $exception){

echo json_encode(['status'=>'in exception','redirect'=>'trainersign,html']);
            exit();
        }

    }
    else{

        echo json_encode(['status'=>'in else','redirect'=>'trainersign,html']);

        exit();
    }

}
