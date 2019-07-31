<?php
    session_start();

    // Connect
    $db = mysqli_connect("localhost", "peter", "194221421942");
    mysqli_select_db($db, "login");

    // Logout Button
    if(isset($_GET['logout'])) {
        session_unset();
        session_destroy();

        echo '<script type="text/javascript">setTimeout(function () { Swal.fire({position: "center", type: "success", title: "You have been successfully logged out!", showConfirmButton: false, timer: 3000})});</script>';

        header("refresh:3; url=index.php"); // Redirect to Index Page
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Active! Tech</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap-grid.css">
    <link rel="stylesheet" href="./css/bootstrap-reboot.css">
    <link rel="stylesheet" href="./css/sweetalert2.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>
    <script defer src="./js/all.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBv_KF8rGPOBKz5sFl_B9nnpQx_2u10q8Q&callback=initMap"></script>
    <script src="./js/sweetalert2.min.js"></script>
    <script src="./js/javascript.js"></script>
    <script>
        // Ajax Search bar
        $(document).ready(function(e) {
            $("#search_input").keyup(function() {
                var x = $(this).val();

                $.ajax({
                    type:'GET',
                    url:'searchbar.php',
                    data:'q='+x,
                    success:function(data) {

                        // Auto slide up and down
                        $(document).click(function(e) {
                            if($(e.target).closest("#search_box").length === 0) {
                                $("#search_box").slideUp('medium');
                            }
                        });
                        $("#search_box").html(data);
                        $("#search_box").slideDown('medium');

                    },
                    
                });
            });
        });
    </script>
</head>

<body data-spy="scroll" data-target="#navbarResponsive">

    <div id="Home">

        <nav class="navbar navbar-expand-md navbar-dark bg-grey fixed-top">
            <a class="navbar-brand" href="index.php"><img src="img/logo2.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-thing">
                        <a class="nav-link" href="#create">Create Event</a>
                    </li>
                    <li class="nav-thing">
                        <?php

                            if($_SERVER['PHP_SELF']) {
                                if(isset($_SESSION['username'])) {
                                    echo "<a class='nav-link' name='logout' href='profile.php?logout=true'>Logout</a>";
                                } else {
                                    echo "<a class='nav-link' name='logout' href='login.php'>Login</a>";
                                }
                            }
                            
                        ?>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="landing">
            <div class="home-package">
                <div class="home-inner">

                </div>
            </div>
        </div>

        <div class="caption text-center">
            <h1>Here is the tech category!</h1>
            <h3>It's time to host an event by yourself !</h3>
            <div class="pad">
                <a class="btn btn-outline-light bgc1 btn-lg" href="#create">Create Event</a>
                <a class="btn btn-outline-light bgc2 btn-lg" href="#info">Tech Info</a>
            </div>
        </div>

    <div id="info">

        <div class="jumbotron container-fluid padding">
            <div class="row intro text-center">
                <div class="col-12">
                    <h1 class="display-5">Tech Details</h1>
                </div>
                <hr>
            </div>

            <div class="row text-center padding">
                <div class="col-xs-12 col-sm-6 col-md-6 feature">
                    <i class="fas fa-user"></i>
                    <h3>Tech</h3>
                    <p>User can find lots of different technologies from this website!</p>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 feature">
                    <i class="fas fa-ticket-alt"></i>
                    <h3>Book a Ticket</h3>
                    <p>Wanna find the ticket you want in the internet? We provided a booking online system for users to book the tickets. To increase the efficient and convenient, online payment system is acceptable to book your tickets.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Search Bar Section -->

    <div id="search">
        <div class="col-12 narrow text-center">
            <h1>Search the Events you want !</h1>
            <div class="input-group">
                <input type="search" name="search" id="search_input" class="form-control" placeholder="Search Your Event">
                <span class="input-group-btn">
                    <button class="btn btn-search" type="button"><i class="fa fa-search fa-fw"></i> Search</button>
                </span>
                <div id="search_box">
                </div>
            </div>
	    </div>
    </div>


    <!-- Contact(Footer) Section -->
    <div id="contact">
        <footer>
            <div class="container-fluid1 padding">
                <div class="row text-center">
                    <div class="col-md-4">
                        <a href="index.php"><img src="img/logo2.png" alt="logo"></a>
                        <hr class="light">
                        <p>0423-123-456</p>
                        <p>active@gmail.com</p>
                    </div>

                    <div class="col-md-4">
                        <hr class="light">
                        <h5>Account Info</h5>
                        <hr class="light">
                        <p><a class="nav-link" href="profile.php">Your Account</a></p>
                    </div>

                    <div class="col-md-4">
                        <hr class="light">
                        <h5>Let Us Help You</h5>
                        <hr class="light">
                        <p><a class="nav-link" href="#Help">Help</a></p>
                    </div>

                    <div class="col-lg-10 center">
                        <hr class="light">
                        <h5>Connect</h5>
                        <hr class="light">
                        <div class="row text-center padding">
                            <div class="col-12 social padding">
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="light-100">
                        <h5>&copy; Active! 2019</h5>
                    </div>
                </div>
            </div>
        </footer>
    </div>


</body>
</html>