<?php
$conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    session_start();
    $username=$_POST['user'];
    $password=$_POST['password'];




    $sqlPlayer = "SELECT username FROM Players WHERE username = '$username' AND Password = '$password'";
    $sqlTrainer = "SELECT username FROM Trainer WHERE username = '$username' AND Password = '$password'";


    $fetchPlayer=$conn->query($sqlPlayer);
    $fetchTrainer=$conn->query($sqlTrainer);

    if($fetchPlayer || $fetchTrainer){
        if($fetchPlayer->num_rows>0){
       $playerRow = $fetchPlayer->fetch_assoc();
          $_SESSION['name'] = $playerRow['username'];
          header("Location: player.php");
            exit();

        }
          if($fetchTrainer->num_rows>0){
            $trainerRow = $fetchTrainer->fetch_assoc();
            $_SESSION['name'] = $trainerRow['username'];
       header("Location: trainer.php");


        }
        else{

      header("Location: signin.php");
        }


    }




}
?>