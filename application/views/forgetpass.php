<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/login.css">
    <script src="<?php echo base_url();?>/assets/js/javascript.js"></script>
</head>

    <div class="caption position text-center">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-4">
                <div class="card-body">
                    <h5 class="card-title text-center font-weight-bold">Reset Password</h5>
                    <a href="<?php echo site_url('Home'); ?>"><span class="close" title="Close PopUp">&times;</span></a>
                    <form class="form-signin" method="post" action="<?php echo base_url('Login/resetlink')?>">
                        <label for="inputEmail" class="color">Email address</label>
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" value="" required autofocus>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block text-uppercase" name="request" type="submit">REQUEST NEW PASSWORD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>