<?php
    session_start();

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
    <title>Active!</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap-grid.css">
    <link rel="stylesheet" href="./css/bootstrap-reboot.css">
    <link rel="stylesheet" href="./css/sweetalert2.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>
    <script defer src="./js/all.js"></script>
    <script src="./js/sweetalert2.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBv_KF8rGPOBKz5sFl_B9nnpQx_2u10q8Q&callback=initMap"></script>
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
                        <a class='nav-link' href='#create'>Create Event</a>
                    </li>
                    <li class="nav-thing">
                        <?php

                            if(isset($_SESSION['username'])) {
                                echo "<a class='nav-link' href='profile.php'>Profile</a>";
                            } else {
                                echo "<a class='nav-link' href='login.php'>Login</a>";
                            }

                        ?>
                    </li>
                    <li class="nav-thing">
                        <?php

                            if(isset($_SESSION['username'])) {
                                echo "<a class='nav-link' href='index.php?logout=true'>Logout</a>";
                            } else {
                                echo "<a class='nav-link' href='signup.php'>Sign Up</a>";
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
            <h1>It's time to host an event by yourself !</h1>
            <h3>Create your own event to your friend and have fun with them !</h3>
            <div class="pad">
                <a class="btn btn-outline-light bgc1 btn-lg" href="#create">Create Event</a>
                <a class="btn btn-outline-light bgc2 btn-lg" href="#intro">Learn More</a>
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
    <div id="here"></div>

    <!-- Introduction Section -->

    <div id="intro">

        <div class="jumbotron container-fluid padding">
            <div class="row intro text-center">
                <div class="col-12">
                    <h1 class="display-5">What is Active?</h1>
                </div>
                <hr>
                <div class="col-12">
                    <p class="lead">Active is an event scheduler which help the customers to create their events and provides booking services. You can do your event privately or publicly, invite friends to your event and generate your own banner.</p>
                </div>
                <hr>
            </div>

            <div class="row text-center padding">
                <div class="col-xs-12 col-sm-6 col-md-4 feature">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Create or Find an Event</h3>
                    <p>Users can create their own events from this website. There are lots of category for users to choose and create. Also, we have searching events feature for some users to find their interested events. It is a great opportunity to get out of your comfort zone and meet some new people!</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 feature">
                    <i class="fas fa-ticket-alt"></i>
                    <h3>Book a Ticket</h3>
                    <p>Wanna find the ticket you want in the internet? We provided a booking online system for users to book the tickets. To increase the efficient and convenient, online payment system is acceptable to book your tickets.</p>
                </div>
                <div class="col-xs-12 col-md-4 feature">
                    <i class="fas fa-image"></i>
                    <h3>Banner Generator</h3>
                    <p>We also provided a banner generator for users. You can add your own text to the image. To know more about our generator, please see our banner generator page to understand how is it works!</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Google Map Section -->

    <div id="gmap">
        <div class="row size text-center">
            <div class="col-12">
                <h1 class="display-5">View Your Nearby Events</h1>
            </div>
            <hr>
            <div class="col-12">
                <p class="lead">Active! provided a Google Map Searching system for users to find their interested events nearby. </p>
            </div>
            <hr>
        </div>

        <div class="size-map">
            <div id="map">
                <!--<iframe src="" style="border:0" allowfullscreen="" width="600" height="450" frameborder="0"></iframe>-->
                <!--https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France-->
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
                        <p><a class="nav-link" href="#login">Your Account</a></p>
                        <p><a class="nav-link" href="login.php">Login</a></p>
                        <p><a class="nav-link" href="signup.php">Sign Up</a></p>
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