<!doctype html>
<html lang="en">
<head>
    <title>Table 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/tableStyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
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
                        } else {
                            if (isset($_SESSION['name'])) {
                                $username = $_SESSION['name'];
                                $sqlTrainer = "SELECT * FROM Trainer WHERE username='$username'";
                                $fetchTrainer = $conn->query($sqlTrainer);
                                $sqlPlayer = "SELECT * FROM Players WHERE username='$username'";
                                $fetchPlayer = $conn->query($sqlPlayer);

                                echo ' <li class="active"><a href="table.php" class="nav-link">Players</a></li>';
                                echo '<li><a href="matches.php" class="nav-link">Matches</a></li>';
                                echo '<li><a href="createMatch.php" class="nav-link">Create Match</a></li>';
                                echo '<li><a href="blog.php" class="nav-link">Blog</a></li>';
                                echo '<li><a href="contact.html" class="nav-link">Contact</a></li>';

                                if ($fetchPlayer->num_rows > 0) {
                                    echo '<li ><a href="player.php">Player</a></li>';
                                } else if ($fetchTrainer->num_rows > 0) {
                                    echo '<li ><a href="trainer.php">Trainer</a></li>';
                                }
                                echo " <li><a href='logout.php' class='nav-link'>Logout</a></li>";
                            } else {
                                echo " <li><a href='signin.php' class='nav-link'>SignIn</a></li>";
                            }
                        }
                        ?>
                        <li><a href="signup.html" class="nav-link">SignUp</a></li>
                    </ul>
                </nav>
                <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right text-white"><span class="icon-menu h3 text-white"></span></a>
            </div>
        </div>
    </div>
</header>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Players in Your Team</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <form method="post" action="save_changes.php">
                        <table class="table table-bordered table-dark table-hover" id="playerTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Length</th>
                                <th>Weight</th>
                                <th>Team</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-dark table-hover" id="newPlayerTable">
                            <thead>
                            <tr>
                                <th>User Name</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Length</th>
                                <th>Weight</th>
                                <th>Password</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type='text' id='PlayerUsername' required></td>
                                <td><input type='text' id='FirstName' required></td>
                                <td><input type='text' id='LastName' required></td>
                                <td><input type='email' id='Email' required></td>
                                <td><input type='number' id='Length' required></td>
                                <td><input type='number' id='Weight' required></td>
                                <td><input type='password' id='Password' required></td>
                                <td><button type='button' id='insertButton'>Insert</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script>
    let i = 0;

    $(document).ready(function() {

        function loadPlayers() {
            $.ajax({
                url: 'tableAPI.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#playerTable tbody').empty();
                    i = 0;

                    $.each(data, function(index, player) {
                        i++;
                        $('#playerTable tbody').append(`
                                <tr class="player-row">
                                    <td>${i}</td>
                                  <td><input type='text' name='username[]' value='${player.username}' readonly ></td>
                                <td><input type='text' name='FirstName[]' value='${player.FirstName}' required></td>
                                <td><input type='text' name='LastName[]' value='${player.LastName}' required></td>
                                <td><input type='email' name='Email[]' value='${player.Email}' required></td>
                                <td><input type='number' name='Length[]' value='${player.Length}' required></td>
                                <td><input type='number' name='Weight[]' value='${player.Weight}' required></td>
                                <td><input type='text' name='Team[]' value='${player.Team}' readonly></td>
                                <td style='display: flex;'>
                                    <button type='button' class="update" data-username='${player.username}'>Update</button>
                                    <button type='button' class="delete" data-username='${player.username}' onclick="deletePlayer('${player.username}')">Delete</button>
                                </td>
                                </tr>
                            `);
                    });
                },
                error: function() {
                    alert('Failed to fetch data from the server');
                }
            });
        }

        $(document).on('click', '.delete', function() {
            var username = $(this).data('username');


            $.ajax({
                url: 'deletePlayer.php',
                method: 'DELETE',
                contentType: 'application/json',
                data: JSON.stringify({ username: username }),
                success: function() {

                    loadPlayers();
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error);
                }
            });
        });

        $(document).on('click', '.update', function() {
            const username = $(this).data('username');


            const row = $(this).closest('.player-row');
            const updatedPlayerData = {
                username: username,
                FirstName: row.find('input[name="FirstName[]"]').val(),
                LastName: row.find('input[name="LastName[]"]').val(),
                Email: row.find('input[name="Email[]"]').val(),
                Length: row.find('input[name="Length[]"]').val(),
                Weight: row.find('input[name="Weight[]"]').val(),
                Team: row.find('input[name="Team[]"]').val()
            };

            $.ajax({
                url: 'updatePlayer.php',
                method: 'PATCH',
                contentType: 'application/json',
                data: JSON.stringify(updatedPlayerData),
                success: function(response) {

                    loadPlayers();

                },
                error: function(xhr, status, error) {
                    alert("Error: " + error);
                }
            });
        });


        $('#insertButton').click(function() {

            const playerData = {
                PlayerUsername: $('#PlayerUsername').val(),
                FirstName: $('#FirstName').val(),
                LastName: $('#LastName').val(),
                Email: $('#Email').val(),
                Length: $('#Length').val(),
                Weight: $('#Weight').val(),
                Password: $('#Password').val()
            };

            $.ajax({
                url: 'tableAPI.php',
                method: 'POST',
                data: JSON.stringify(playerData),
                contentType: 'application/json',
                success: function() {

                    loadPlayers();
                },
                error: function(xhr) {
                    alert('Failed to insert player: ' + xhr.responseText);
                }
            });
        });

        loadPlayers();
    });
</script>
<style>
    input {
        background-color: transparent;
        color: white;
        border-color: transparent;
        width: 100px;
    }
    input:hover {
        background-color: gray;
        border-color: transparent;
    }

    button {
        display: flex;
        padding: 3px;
        background-color: transparent;
        border-color: transparent;
        color: white;
    }
    button:hover {
        background-color: gray;
        border-color: transparent;
    }
</style>
</body>
</html>
