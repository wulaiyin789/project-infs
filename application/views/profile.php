<head>
    <script src="<?php echo base_url();?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/dropzone.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        var dropanddrag = new Dropzone("#dropanddrag", {
            url: "<?php echo site_url("profile/upload") ?>",
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            removedfile: function(file) {
                var name = file.name;

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url("profile/remove") ?>",
                    data: { file: name },
                    dataType: 'HTML'
                });

                // Remove the thumbnail
                var previewElement;
                return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            },
            init: function() {
                var me = this;
                $.get("<?php echo site_url("profile/list_files") ?>", 

                    function(data) {

                        // If any files already in server show all here
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                var mockFile = value;
                                me.emit("addedfile", mockFile);
                                me.emit("thumbnail", mockFile, "<?php echo base_url(); ?>uploads/" + value.name);
                                me.emit("complete", mockFile);
                            });
                    }
                });
            }
        });
    </script>
</head>

<div class="caption text-center">
    <h1>Welcome 
        <?php 
            $logout = $this->input->get('logout');
            if(isset($logout)) {
                echo "";
            } else {
                echo $this->session->userdata('username');
            }

            if(!isset($_SERVER['HTTP_REFERER'])) {
                echo "";
            } else {
                echo "";                    
            }

        ?>
    </h1>
    <h3>It's time to host an event by yourself !</h3>
    <div class="pad">
        <a class="btn btn-outline-light bgc1 btn-lg" href="#create">Create Event</a>
        <a class="btn btn-outline-light bgc2 btn-lg" href="#info">Account Info</a>
    </div>
</div>

<div id="info">

    <div class="jumbotron container-fluid padding">
        <div class="row intro text-center">
            <div class="col-12">
                <h1 class="display-5">Your Account Detail</h1>
            </div>
            <hr>
        </div>

        <div class="row text-center padding">
            <div class="col-xs-12 col-sm-6 col-md-6 feature">

                <div id="upload">
                    <div id="dropanddrag" class="dropzone">
                        <div class="dz-message">
                            <h3>Drop files here</h3> or <strong>click</strong> to upload
                        </div>
                    </div>
                </div>

                <form method="post">
                    <table align="center">
                        <tr>
                            <td>Username:</td>
                            <td>
                                <input type="text" name="username" value="<?= $this->session->userdata('username')?>" class="form-control">
                                    <?= form_error('username'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>
                                <input type="text" name="email" value="<?= $this->session->userdata('email')?>" class="form-control">
                                <?= form_error('email'); ?>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <button type="submit" class="btn btn-outline-primary btn-lg">Update profile</button>

                    <?php 
                        if($this->session->flashdata('success')) { 
                            echo '<p class="alert alert-success">' .$this->session->flashdata('success'). '</p>';
                            $this->session->unset_userdata('success');
                        } 
                    ?>
                    <?php 
                        if($this->session->flashdata('error')) { 
                            echo '<p class="alert alert-warning">' .$this->session->flashdata('error'). '</p>';
                            $this->session->unset_userdata('error');
                        }
                    ?>
                </form>
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

<?php

    // Prevent direct access to user profile
    if(!isset($_SERVER['HTTP_REFERER'])) {
        if(error_reporting(0)) {
            echo "";
        }

        if(!isset($_SESSION['username'])) {
            echo '<script type="text/javascript">setTimeout(function () { Swal.fire({position: "center", type: "error", title: "Invalid Access to Profile", showConfirmButton: false, timer: 2000})});</script>';

            header("refresh:3; url=https://infs3202-a9f37524.uqcloud.net/"); // Redirect to Index Page
        }
    }

?>