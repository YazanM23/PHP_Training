

<!doctype html>
<html lang="en">
<head>
    <title>Table 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/tableStyle.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">


</head>

<body>
<header class="site-navbar py-4" role="banner">

    <div class="container">
        <div class="d-flex align-items-center">
            <div class="site-logo">
                <a href="index.php">
                    <img src="images/logo.png" alt="Logo">
                </a>
            </div>
            <div class="ml-auto">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <?php


                        session_start();
                        if (isset($_SESSION['name'])) {
                            $username = $_SESSION['name'];
                            $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } else {
                                $sql = "SELECT username FROM Trainer WHERE username = '$username'";
                                $flag = false;
                                $fetch = $conn->query($sql);


                                if ($fetch) {
                                    if (!$fetch->num_rows > 0) {
                                        header("Location: signin.php");
                                        exit();
                                    }

                                }

                            }
                        } else {

                            header("Location: signin.php");
                            exit();

                        }


                        $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        else {

                            if(isset($_SESSION['name'])){
                                $username=$_SESSION['name'];
                                $sqlTrainer="SELECT * FROM Trainer WHERE username='$username'";
                                $fetchTrainer=$conn->query($sqlTrainer);
                                $sqlPlayer="SELECT * FROM Players WHERE username='$username'";
                                $fetchPlayer=$conn->query($sqlPlayer);

                                echo ' <li><a href="table.php" class="nav-link">Players</a></li>';
                                echo '<li><a href="matches.php" class="nav-link">Matches</a></li>';
                                echo '<li class="active"><a href="createMatch.php" class="nav-link">Create Match</a></li>';
                                echo '<li><a href="blog.php" class="nav-link">Blog</a></li>';
                                echo '<li><a href="contact.html" class="nav-link">Contact</a></li>';

                                if($fetchPlayer->num_rows>0){

                                    echo '<li ><a href="player.php">Player</a></li>';

                                }
                                else if($fetchTrainer->num_rows>0){
                                    echo '<li ><a href="trainer.php">Trainer</a></li>';
                                }
                                echo " <li><a href='logout.php' class='nav-link'>Logout</a></li>";


                            }
                            else{
                                echo " <li><a href='signin.php' class='nav-link'>SignIn</a></li>";
                            }
                        }


                        ?>
                        <li><a href="signup.html" class="nav-link">SingUp</a></li>

                    </ul>
                </nav>

                <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right text-white"><span
                            class="icon-menu h3 text-white"></span></a>
            </div>
        </div>
    </div>

</header>


<!--<div class="hero overlay" style="background-image: url('images/bg_3.jpg');">-->
<section class="ftco-section" >
    <div class="container" >
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Create Match</h2>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-12" >
                <div class="table-wrap" >
                    <h1>Create Match</h1><br>
                    <form action="create_match.php" method="POST">
                        <label for="team1_name">Enter Team 1 Name:</label>
                        <input type="text" id="team1_name" name="team1_name" required>

                        <label for="team2_name">Enter Team 2 Name:</label>
                        <input type="text" id="team2_name" name="team2_name" required>
                        <br><br>
                        <label for="team1_name">Enter Team 1 Result:</label>
                        <input type="number" id="team1_name" name="team1_result" >
                        <label for="team2_name">Enter Team 2 Result:</label>
                        <input type="number" id="team2_name" name="team2_result" >
                        <br>
                        <br>
                        <label for="team1_players">Select Players for Team 1:</label>
                        <select id="team1_players" name="team1_players[]" multiple required>

                            <?php
                            session_start();
                            $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            else {
                                $username=$_SESSION['name'];
                                $sql="SELECT * FROM Players WHERE Team=(SELECT Team FROM Trainer WHERE username='$username')";
                                $fetch= $conn->query($sql);

                                for($i=0;$i<$fetch->num_rows;$i++){
                                    $rows=$fetch->fetch_assoc();
                                    echo "<option value='{$rows['username']}'>{$rows['username']}</option>";
                                }

                            }

                            ?>
                        </select>
                        <br>

                        <label for="team2_players">Select Players for Team 2:</label>
                        <select id="team2_players" name="team2_players[]" multiple required>
                            <?php
                            session_start();
                            $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            else {
                                $username=$_SESSION['name'];
                                $sql="SELECT * FROM Players WHERE Team=(SELECT Team FROM Trainer WHERE username='$username')";
                                $fetch= $conn->query($sql);

                                for($i=0;$i<$fetch->num_rows;$i++){
                                    $rows=$fetch->fetch_assoc();
                                    echo "<option value='{$rows['username']}'>{$rows['username']}</option>";
                                }

                            }

                            ?>
                        </select>
<br>
                        <label for="match_date">Match Date:</label>
                        <input type="datetime-local" id="match_date" name="match_date" required>

                        <button type="submit">Create Match</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--</div>-->

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
<style>
    input{
        background-color: transparent;
        color: white;
        border-color:white;
    }
    input:hover{
        background-color: gray;
        border-color:transparent;
    }

    button{
        display: flex;
        padding: 3px;
        background-color: transparent;
        border-color:transparent;
        color: white;

    }
    button:hover{
        background-color: gray;
        border-color:transparent;
    }
select{
    background-color: transparent;
    color: white;
}
</style>

</script>
</html>

