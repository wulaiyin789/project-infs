<?php
    // If user directly go to login page, it will show error message
    if(!isset($_SERVER['HTTP_REFERER'])) {
        if(isset($_SESSION['username'])) {
            echo '<script type="text/javascript">setTimeout(function () { Swal.fire({position: "center", type: "success", title: "You have been logged already!", showConfirmButton: false, timer: 2000})});</script>';

            header("refresh:2; url=http://localhost/"); // Redirect to Index Page
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="<?php echo base_url();?>/assets/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/login.css">
    <script src="<?php echo base_url();?>/assets/js/javascript.js"></script>
    <script>

        // Script for the refresh button
        $(document).ready(function(){
            $('.captcha_refresh').click(function(){
                // Get the info and refresh the captcha
                $.get('<?php echo base_url().'login/refresh_capt'; ?>', function(data){
                    $('#captchaImg').html(data);
                });
            });
        });

    </script>
</head>

    <div class="caption position text-center">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-4">
                <div class="card-body">
                    <h5 class="card-title text-center font-weight-bold">Member Login</h5>
                    <a href="<?php echo site_url('Home'); ?>"><span class="close" title="Close PopUp">&times;</span></a>
                    <form class="form-signin" method="post">

                        <?php 
                            if($this->session->flashdata('error')) { 
                                echo '<p class="alert alert-warning">' .$this->session->flashdata('error'). '</p>';
                                $this->session->unset_userdata('error');
                            }
                        ?>

                        <label for="inputEmail" class="color">Email address</label>
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" value="<?php if (isset($_COOKIE["email"])): echo $_COOKIE["email"]; endif ?>" required autofocus>
                        </div>

                        <label for="inputPassword" class="color">Password</label>
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                        </div>

                        <?php 
                            if($this->session->flashdata('error_validation')) { 
                                echo '<p class="alert alert-warning">' .$this->session->flashdata('error_validation'). '</p>';
                                $this->session->unset_userdata('error_validation');
                            }
                        ?>

                        <p id="captchaImg"><?php echo $captcha_img ?></p>
                        <p>Can't read the image? Click <a href="javascript:void(0);" class="captcha_refresh">here</a> to refresh.</p>
                        Enter the code : 
                        <input type="text" class="form-control" name="captcha" required>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="rememberme">
                            <label class="custom-control-label color" for="customCheck1">Remember password</label>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck2" <?php if (isset($_COOKIE["email"])): echo "checked"; endif ?> name="deletecookie">
                            <label class="custom-control-label color" for="customCheck2">Delete All Cookies</label>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <a class="color" href="<?php echo base_url('Login/forgetpass');?>">Foreget your Password?</a>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block text-uppercase" name="login" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

