<?php
session_start();
$flag=false;
if($_SERVER['REQUEST_METHOD']==='POST'){
    $team1_name = $_POST['team1_name'];
    $team2_name = $_POST['team2_name'];

    if(isset( $_POST['team1_result']) && $_POST['team2_result']){
        $team1_result = $_POST['team1_result'];
        $team2_result = $_POST['team2_result'];
        $flag=true;
    }

    $team1_players = $_POST['team1_players'];
    $team2_players = $_POST['team2_players'];
    $match_date = $_POST['match_date'];
    $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        $common_players = array_intersect($team1_players, $team2_players);
        if (!empty($common_players)) {
            header("Location: createMatch.php");
            exit();
        }
        $username=$_SESSION['name'];
        $sql="INSERT INTO Team (name) VALUES ('$team1_name')";
        $conn->query($sql);
        $team1_id = $conn->insert_id;

        $sql="INSERT INTO Team (name) VALUES ('$team2_name')";
        $conn->query($sql);
        $team2_id = $conn->insert_id;
if($flag) {
    $sql = "INSERT INTO Matches (idTeam1, idTeam2, Date, Team1Res, Team2Res,done) VALUES ('$team1_id','$team2_id','$match_date','$team1_result','$team2_result','yes')";
    $conn->query($sql);
}
else{
    $sql = "INSERT INTO Matches (idTeam1, idTeam2, Date,done) VALUES ('$team1_id','$team2_id','$match_date','no')";
    $conn->query($sql);
}


        foreach ($team1_players as $player_user) {
            $sql = ("INSERT INTO team_players (idTeam, usernamePlayer) VALUES ('$team1_id', '$player_user')");
           $conn->query($sql);
        }
        foreach ($team2_players as $player_user) {
            $sql = ("INSERT INTO team_players (idTeam, usernamePlayer) VALUES ('$team2_id', '$player_user')");
            $conn->query($sql);
        }
        header("Location: trainer.php");
        exit();
    }
}