<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css">
    <script src="<?php echo base_url();?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>/assets/js/bootstrap.bundle.js"></script>
    <script src="<?php echo base_url();?>/assets/js/all.js"></script>
    <script src="<?php echo base_url();?>/assets/js/sweetalert2.min.js"></script>
    <script>
        // Ajax Search bar
        $(document).ready(function(e) {
            $("#search_input").keyup(function() {
                var x = $(this).val();

                $.ajax({
                    type:'GET',
                    url:'<?php echo base_url();?>/Home/searchbar',
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
            <a class="navbar-brand" href="<?php echo base_url('Home'); ?>"><img src="<?php echo base_url();?>/assets/img/logo2.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-thing">
                        <a class='nav-link' href='#create'>Create Event</a>
                    </li>
                    <li class="nav-thing">
                        <a class='nav-link' href='<?php echo base_url('Events'); ?>'>Add Events</a>
                    </li>
                    <li class="nav-thing">
                        <?php
                            $user = $this->session->userdata('username');
                            if(isset($user)) {
                                echo "<a class='nav-link' href='".base_url()."Profile'>Profile</a>";
                            } else {
                                echo "<a class='nav-link' href='".base_url()."Login'>Login</a>";
                            }

                        ?>
                    </li>
                    <li class="nav-thing">
                        <?php

                            $user = $this->session->userdata('username');
                            if(isset($user)) {
                                echo "<a class='nav-link' href='".base_url()."Home/logout'>Logout</a>";  // Problem!!!!!!
                            } else {
                                echo "<a class='nav-link' href='".base_url()."Signup'>Sign Up</a>";
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

    </div>

    <?php $this->load->view($page); ?>

    <!-- Contact(Footer) Section -->
    <div id="contact">
        <footer>
            <div class="container-fluid1 padding">
                <div class="row text-center">
                    <div class="col-md-4">
                        <a href="index.php"><img src="<?php echo base_url();?>/assets/img/logo2.png" alt="logo"></a>
                        <hr class="light">
                        <p>0423-123-456</p>
                        <p>active@gmail.com</p>
                    </div>

                    <div class="col-md-4">
                        <hr class="light">
                        <h5>Account Info</h5>
                        <hr class="light">
                        <p>
                            <?php
                                $user = $this->session->userdata('username');
                                if(isset($user)) {
                                    echo "<a class='nav-link' href='".base_url()."Profile'>Your Account</a>";
                                } else {
                                    echo " ";
                                }
                            ?>
                        </p>
                        <p>
                            <?php
                                $user = $this->session->userdata('username');
                                if(!isset($user)) {
                                    echo "<a class='nav-link' href='".base_url()."Login'>Login</a>";
                                } else {
                                    echo " ";
                                }
                            ?>
                        </p>
                        <p>                            
                            <?php
                                $user = $this->session->userdata('username');
                                if(!isset($user)) {
                                    echo "<a class='nav-link' href='".base_url()."Signup'>Sign up</a>";
                                } else {
                                    echo " ";
                                }
                            ?>
                        </p>
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
