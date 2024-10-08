<?php
$conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    $username=$_POST['user'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $team=$_POST['team'];



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
        echo "done insert";
        header("Location: signin.php");
        exit(); // Important to stop further script execution
    }
    catch (Exception $exception){
        header("Location: trainersign.html");

        exit();
    }

}
else{
    header("Location: trainersign.html");

    exit();
}




}
?>