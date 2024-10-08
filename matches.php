<!DOCTYPE html>
<html lang="en">

<head>
  <title>Soccer &mdash; Website by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


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
                    $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    else {
                        echo ' <li><a href="index.php" class="nav-link">Home</a></li>';
                        echo '<li class="active"><a href="matches.php" >Matches</a></li>';
                        echo '<li><a href="players.php" class="nav-link">Players</a></li>';
                        echo '<li><a href="blog.php" class="nav-link">Blog</a></li>';
                        echo '<li><a href="contact.php" class="nav-link">Contact</a></li>';

                        if(isset($_SESSION['name'])){
                            $username=$_SESSION['name'];
                            $sqlTrainer="SELECT * FROM Trainer WHERE username='$username'";
                            $fetchTrainer=$conn->query($sqlTrainer);
                            $sqlPlayer="SELECT * FROM Players WHERE username='$username'";
                            $fetchPlayer=$conn->query($sqlPlayer);


                            if($fetchPlayer->num_rows>0){

                                echo '<li><a href="player.php" class="nav-link">Player</a></li>';

                            }
                            else if($fetchTrainer->num_rows>0){
                                echo '<li><a href="trainer.php" class="nav-link">Trainer</a></li>';
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

    <div class="hero overlay" style="background-image: url('images/bg_3.jpg');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 mx-auto text-center">
            <h1 class="text-white">Matches</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, molestias repudiandae pariatur.</p>
          </div>
        </div>
      </div>
    </div>

    
    
    <div class="container">
      

      <div class="row">
        <div class="col-lg-12">
          
          <div class="d-flex team-vs">
            <span class="score"> <?php
                $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                else {


                    $sql="SELECT Team1Res,Team2Res FROM Matches ORDER BY Date DESC LIMIT 1 ";
                    $fetch=$conn->query($sql);
                    if($fetch->num_rows>0){


                    $row=$fetch->fetch_assoc();
                    $team1Res=$row['Team1Res'];
                    $team2Res=$row['Team2Res'];

                 echo $team1Res."-".$team2Res;
                    }
                    else{
                        echo "0"."-"."0";
                    }

                }
                ?></span>
            <div class="team-1 w-50">
              <div class="team-details w-100 text-center">
                <img src="images/logo_1.png" alt="Image" class="img-fluid">
                <h3>
                    <?php
                    $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    else {

                        $sql="SELECT name FROM Team WHERE Team.id=
(SELECT idTeam1 FROM Matches WHERE done='yes' ORDER BY Date DESC LIMIT 1)";
                       $fetch= $conn->query($sql);
                       $row=$fetch->fetch_assoc();
                       echo $row['name'];
                       $sql="SELECT Team1Res,Team2Res FROM Matches ORDER BY Date DESC LIMIT 1 ";
$fetch=$conn->query($sql);
$row=$fetch->fetch_assoc();
$team1Res=$row['Team1Res'];
                        $team2Res=$row['Team2Res'];

                        if($team1Res>$team2Res){
                            echo "<span>(win)</span>";
                        }
                        else if($team1Res<$team2Res){
                            echo "<span>(lose)</span>";
                        }
                        else{
                            echo "<span>(draw)</span>";
                        }

                    }
                    ?>
                  </h3>
                <ul class="list-unstyled">
                  <li>Anja Landry (7)</li>
                  <li>Eadie Salinas (12)</li>
                  <li>Ashton Allen (10)</li>
                  <li>Baxter Metcalfe (5)</li>
                </ul>
              </div>
            </div>
            <div class="team-2 w-50">
              <div class="team-details w-100 text-center">
                <img src="images/logo_2.png" alt="Image" class="img-fluid">
                <h3>     <?php
                    $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    else {

                        $sql="SELECT name FROM Team WHERE Team.id=
                        (SELECT idTeam2 FROM Matches WHERE done='yes' ORDER BY Date DESC LIMIT 1)";
                        $fetch= $conn->query($sql);
                        $row=$fetch->fetch_assoc();
                        echo $row['name'];
                        $sql="SELECT Team1Res,Team2Res FROM Matches ORDER BY Date DESC LIMIT 1 ";
                        $fetch=$conn->query($sql);
                        $row=$fetch->fetch_assoc();
                        $team1Res=$row['Team1Res'];
                        $team2Res=$row['Team2Res'];

                        if($team1Res<$team2Res){
                            echo "<span>(win)</span>";
                        }
                        else if($team1Res>$team2Res){
                            echo "<span>(lose)</span>";
                        }
                        else{
                            echo "<span>(draw)</span>";
                        }

                    }
                    ?></h3>
                <ul class="list-unstyled">
                  <li>Macauly Green (3)</li>
                  <li>Arham Stark (8)</li>
                  <li>Stephan Murillo (9)</li>
                  <li>Ned Ritter (5)</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  

    
    <div class="site-section bg-dark">
      <div class="container">
        
        <div class="row mb-5">
          <div class="col-lg-12">
            <div class="widget-next-match">
              <div class="widget-title">
                <h3>Next Match</h3>
              </div>
              <div class="widget-body mb-3">
                <div class="widget-vs">
                  <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                    <div class="team-1 text-center">
                      <img src="images/logo_1.png" alt="Image">
                      <h3>
                          <?php
                          $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                          if ($conn->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                          }
                          else {
                              $sql="SELECT name FROM Team WHERE Team.id=
                        (SELECT idTeam1 FROM Matches WHERE done='no' ORDER BY Date DESC LIMIT 1)";
                              $fetch= $conn->query($sql);
                              if($fetch->num_rows>0){
                                  $row=$fetch->fetch_assoc();
                                  echo $row['name'];
                              }
                              else{
                                  echo "-";
                              }

                          }
                          ?>

                      </h3>
                    </div>
                    <div>
                      <span class="vs"><span>VS</span></span>
                    </div>
                    <div class="team-2 text-center">
                      <img src="images/logo_2.png" alt="Image">
                      <h3>  <?php
                          $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                          if ($conn->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                          }
                          else {
                              $sql="SELECT name FROM Team WHERE Team.id=
                        (SELECT idTeam2 FROM Matches WHERE done='no' ORDER BY Date DESC LIMIT 1)";
                              $fetch= $conn->query($sql);

                              if($fetch->num_rows>0){
                                  $row=$fetch->fetch_assoc();
                                  echo $row['name'];
                              }
                              else{
                                  echo "-";
                              }
                          }
                          ?></h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-center widget-vs-contents mb-4">
                <h4>World Cup League</h4>
                <p class="mb-5">
                  <span class="d-block"> <?php
                      $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
                      if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                      }
                      else {
                          $sql=" SELECT Date FROM Matches WHERE done='no' ORDER BY Date DESC LIMIT 1";
                          $fetch= $conn->query($sql);
                          if($fetch->num_rows>0){
                              $row=$fetch->fetch_assoc();
                              echo $row['Date'];
                          }
                          else{
                              echo "-";
                          }

                      }
                      ?></span>
                  <span class="d-block">9:30 AM GMT+0</span>
                  <strong class="text-primary">New Euro Arena</strong>
                </p>

                <div id="date-countdown2" class="pb-1"></div>
              </div>
            </div>
          </div>
        </div>
          <div class="row">
              <div class="col-12 title-section">
                  <h2 class="heading">Previous Matches</h2>
              </div>
              <?php
              $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }
              else {
                  $team1 = "";
                  $team2 = "";
                  $date = "";

                  $resultTeam1 = "Result 1";  // Replace this with the result of Team 1
                  $resultTeam2 = "Result 2";

                  $sql=" SELECT idTeam1, idTeam2, Date,Team1Res,Team2Res FROM Matches WHERE done='yes'";
                  $fetch= $conn->query($sql);
                  if($fetch->num_rows>0){

                      for($i=0;$i<$fetch->num_rows;$i++){
                          $row=$fetch->fetch_assoc();
                          $idTeam1=$row['idTeam1'];
                          $idTeam2=$row['idTeam2'];

                          $sql="SELECT Name FROM Team Where id='$idTeam1'";
                          $fetch1= $conn->query($sql);
                          $rows=$fetch1->fetch_assoc();
                          $team1=$rows['Name'];
                          $sql="SELECT Name FROM Team Where id='$idTeam2'";
                          $fetch1= $conn->query($sql);
                          $rows=$fetch1->fetch_assoc();
                          $team2=$rows['Name'];
                          $date=$row['Date'];
                          $resultTeam1=$row['Team1Res'];
                          $resultTeam2=$row['Team2Res'];
                          echo '
<div class="col-lg-6 mb-4">
  <div class="bg-light p-4 rounded">
    <div class="widget-body">
      <div class="widget-vs">
        <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
          <div class="team-1 text-center">
            <img src="images/logo_1.png" alt="Image">
            <h3>' . $team1 . '</h3>
            <p><strong>' . $resultTeam1 . '</strong></p>
          </div>
          <div>
            <span class="vs"><span>VS</span></span>
          </div>
          <div class="team-2 text-center">
            <img src="images/logo_2.png" alt="Image">
            <h3>' . $team2 . '</h3>
            <p><strong>' . $resultTeam2 . '</strong></p>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center widget-vs-contents mb-4">
      <h4>World Cup League</h4>
      <p class="mb-5">
        <span class="d-block">December 20th, 2020</span>
        <span class="d-block">' . $date . '</span>
        <strong class="text-primary">New Euro Arena</strong>
      </p>
    </div>
  </div>
</div>';


                      }
                  }
                  else{
                      echo "-";
                  }

              }


              ?>










          </div>

              <div class="row">
          <div class="col-12 title-section">
            <h2 class="heading">Upcoming Match</h2>
          </div>
            <?php
            $conn = new mysqli('127.0.0.1', 'root', '12345678', 'train1');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            else {
                $team1 = "Your Team 1"; // Replace this with your team name
                $team2 = "Your Team 2"; // Replace this with your team name
                $date = "Your Date";    // Replace this with your desired date



                $sql=" SELECT idTeam1, idTeam2, Date FROM Matches WHERE done='no'";
                $fetch= $conn->query($sql);
                if($fetch->num_rows>0){

                   for($i=0;$i<$fetch->num_rows;$i++){
                       $row=$fetch->fetch_assoc();
                       $idTeam1=$row['idTeam1'];
                       $idTeam2=$row['idTeam2'];

                       $sql="SELECT Name FROM Team Where id='$idTeam1'";
                      $fetch1= $conn->query($sql);
                       $rows=$fetch1->fetch_assoc();
                       $team1=$rows['Name'];
                       $sql="SELECT Name FROM Team Where id='$idTeam2'";
                       $fetch1= $conn->query($sql);
                       $rows=$fetch1->fetch_assoc();
                       $team2=$rows['Name'];
                       $date=$row['Date'];
                      echo    '
<div class="col-lg-6 mb-4">
  <div class="bg-light p-4 rounded">
    <div class="widget-body">
      <div class="widget-vs">
        <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
          <div class="team-1 text-center">
            <img src="images/logo_1.png" alt="Image">
            <h3>' . $team1 . '</h3>
          </div>
          <div>
            <span class="vs"><span>VS</span></span>
          </div>
          <div class="team-2 text-center">
            <img src="images/logo_2.png" alt="Image">
            <h3>' . $team2 . '</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center widget-vs-contents mb-4">
      <h4>World Cup League</h4>
      <p class="mb-5">
        <span class="d-block">December 20th, 2020</span>
        <span class="d-block">' . $date . '</span>
        <strong class="text-primary">New Euro Arena</strong>
      </p>
    </div>
  </div>
</div>';


                   }
                }
                else{
                    echo "-";
                }

            }


            ?>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-6 title-section">
            <h2 class="heading">Videos</h2>
          </div>
          <div class="col-6 text-right">
            <div class="custom-nav">
            <a href="#" class="js-custom-prev-v2"><span class="icon-keyboard_arrow_left"></span></a>
            <span></span>
            <a href="#" class="js-custom-next-v2"><span class="icon-keyboard_arrow_right"></span></a>
            </div>
          </div>
        </div>


        <div class="owl-4-slider owl-carousel">
          <div class="item">
            <div class="video-media">
              <img src="images/img_1.jpg" alt="Image" class="img-fluid">
              <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-0">Dogba set for Juvendu return?</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="item">
            <div class="video-media">
              <img src="images/img_2.jpg" alt="Image" class="img-fluid">
              <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-0">Kai Nets Double To Secure Comfortable Away Win</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="item">
            <div class="video-media">
              <img src="images/img_3.jpg" alt="Image" class="img-fluid">
              <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-0">Romolu to stay at Real Nadrid?</h3>
                </div>
              </a>
            </div>
          </div>

          <div class="item">
            <div class="video-media">
              <img src="images/img_1.jpg" alt="Image" class="img-fluid">
              <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-0">Dogba set for Juvendu return?</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="item">
            <div class="video-media">
              <img src="images/img_2.jpg" alt="Image" class="img-fluid">
              <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-0">Kai Nets Double To Secure Comfortable Away Win</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="item">
            <div class="video-media">
              <img src="images/img_3.jpg" alt="Image" class="img-fluid">
              <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-0">Romolu to stay at Real Nadrid?</h3>
                </div>
              </a>
            </div>
          </div>

        </div>

      </div>
    </div>

    <div class="container site-section">
      <div class="row">
        <div class="col-6 title-section">
          <h2 class="heading">Our Blog</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="custom-media d-flex">
            <div class="img mr-4">
              <img src="images/img_1.jpg" alt="Image" class="img-fluid">
            </div>
            <div class="text">
              <span class="meta">May 20, 2020</span>
              <h3 class="mb-4"><a href="#">Romolu to stay at Real Nadrid?</a></h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus deserunt saepe tempora dolorem.</p>
              <p><a href="#">Read more</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="custom-media d-flex">
            <div class="img mr-4">
              <img src="images/img_3.jpg" alt="Image" class="img-fluid">
            </div>
            <div class="text">
              <span class="meta">May 20, 2020</span>
              <h3 class="mb-4"><a href="#">Romolu to stay at Real Nadrid?</a></h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus deserunt saepe tempora dolorem.</p>
              <p><a href="#">Read more</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>



    <footer class="footer-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>News</h3>
              <ul class="list-unstyled links">
                <li><a href="#">All</a></li>
                <li><a href="#">Club News</a></li>
                <li><a href="#">Media Center</a></li>
                <li><a href="#">Video</a></li>
                <li><a href="#">RSS</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Tickets</h3>
              <ul class="list-unstyled links">
                <li><a href="#">Online Ticket</a></li>
                <li><a href="#">Payment and Prices</a></li>
                <li><a href="#">Contact &amp; Booking</a></li>
                <li><a href="#">Tickets</a></li>
                <li><a href="#">Coupon</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Matches</h3>
              <ul class="list-unstyled links">
                <li><a href="#">Standings</a></li>
                <li><a href="#">World Cup</a></li>
                <li><a href="#">La Lega</a></li>
                <li><a href="#">Hyper Cup</a></li>
                <li><a href="#">World League</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Social</h3>
              <ul class="list-unstyled links">
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">Youtube</a></li>
              </ul>
            </div>
          </div>

        </div>

        <div class="row text-center">
          <div class="col-md-12">
            <div class=" pt-5">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="icon-heart"
                  aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>

        </div>
      </div>
    </footer>



  </div>
  <!-- .site-wrap -->

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>


  <script src="js/main.js"></script>

</body>

</html>