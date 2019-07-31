<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/signup.css">
    <script src="<?php echo base_url();?>/assets/js/javascript.js"></script>
</head>

<div class="caption position text-center">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin">
            <div class="card-body">
                <h5 class="card-title text-center font-weight-bold">Sign Up</h5>
                <a href="<?php echo site_url('Home'); ?>"><span class="close" title="Close PopUp">&times;</span></a>
                <form class="form-signin" action="<?php echo base_url()?>Signup/register" method="post">
                    <label class="color">Username</label>
                    <div class="form-label-group">
                        <input id="inputUsername" class="form-control" placeholder="Username" type="text" name="username" required autofocus>
                    </div>

                    <label for="inputEmail" class="color">Email address</label>
                    <div class="form-label-group">
                        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
                    </div>

                    <label for="inputPassword" class="color">Password</label>
                    <div class="form-label-group">
                        <input type="password" id="InputPassword" class="form-control" placeholder="Password" name="password" required>
                    </div>

                    <label for="inputPassword" class="color">Re-type Password</label>
                    <div class="form-label-group">
                        <input type="password" id="RetypePassword" class="form-control" placeholder="Confirm Password" name="cpassword" required>
                    </div>

                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label color" for="customCheck1">Accept the terms & politics</label>
                    </div>
                    <div class="color">Already have an account?</div>
                    <div class="color padding"><a href="login.php" class="underline">Check Here!</a></div>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="signup">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script src="./js/javascript.js"></script>