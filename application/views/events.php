<head>
    <script src="<?php echo base_url();?>/assets/js/js.cookie.js">
    </script>
    <script>

        // Scroll Position
        $(document).ready(function() {

            // Scroll to the position and saved in the cookie.
            if(Cookies.get('scroll') !== null) {
                $(document).scrollTop(Cookies.get('scroll'));
            }
            
            // When user scroll the page position
            $(window).scroll(function() {
                
                // Set a cookie that holds the scroll position.
                Cookies.set('scroll', $(document).scrollTop());
                
            });

        });

    </script>
</head>

<div class="caption text-center">
    <h1>It's time to add an event by yourself !</h1>
    <div class="pad">
        <a class="btn btn-outline-light bgc1 btn-lg" href="#info">Add Event</a>
    </div>
</div> 

<div id="info">

    <div class="jumbotron container-fluid padding">
        <div class="row intro text-center">
            <div class="col-12">
                <h1 class="display-5">Add Events</h1>
            </div>
            <hr>
        </div>

        <table class="table table-hover table-striped table-bordered" id="event_table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Event Name</th>
                    <th>Number of People</th>
                    <th>Description</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                </tr>
            </tbody>
        </table>

        <div class="text-center padding">
            <div class="col-xs-12 col-sm-6 col-md-12 feature">
                <div class="col-md-1">
                    No.
                    <input type="text" class="form-control input-sm text-right" id="no" readonly>
                </div>
                <div class="col-md-3">
                    Event Name:
                    <input type="text" class="form-control input-sm" id="eventname" required>
                </div>
                <div class="col-md-1">
                    Number of People:
                    <input type="text" class="form-control input-sm" id="numberOfPeople" required>
                </div>
                <div class="col-md-5">
                    Description
                    <input type="text" class="form-control input-sm" id="description" required>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="btn btn-primary btn-sm" id="addEvents" value="Add Events">
                    <input type="text" class="btn btn-success btn-sm" id="addEventsDB" value="Add Events to DB">
                </div>
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

<script src="<?php echo base_url();?>/assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
$(function() {

    // Loop the number.

    var set_number = function() {

        var table_length = $('#event_table tbody tr').length;

        $('#no').val(table_length);
    }

    set_number();

    // Add Events to the table.

    $('#addEvents').click(function() {

        var no = $('#no').val();
        var eventname = $('#eventname').val();
        var numberOfPeople = $('#numberOfPeople').val();
        var description = $('#description').val();

        $('#event_table tbody:last-child').append(

            '<tr>'+
                '<td>'+no+'</td>'+
                '<td>'+eventname+'</td>'+
                '<td>'+numberOfPeople+'</td>'+
                '<td>'+description+'</td>'+
            '</tr>'

        );

        // Clear data in the table.

        $('#no').val('');
        $('#eventname').val('');
        $('#numberOfPeople').val('');
        $('#description').val('');

        set_number();

    });

    // Create array to store data in array list

    $('#addEventsDB').click(function() {

        var table_data = [];

        $('#event_table tr').each(function(row, tr) {

            // Get only the data with value.
            if($(tr).find('td:eq(0)').text() == "") {

            } else {
                var sub = {

                    'no' : $(tr).find('td:eq(0)').text(),
                    'eventname' : $(tr).find('td:eq(1)').text(),
                    'numberOfPeople' : $(tr).find('td:eq(2)').text(),
                    'description' : $(tr).find('td:eq(3)').text(),
                };

                table_data.push(sub);
            }

        });

        // Insert to DB by Ajax function.

        Swal.fire({

            title : 'Save all in DB?',
            text : '',
            type : '',
            showLoaderOnConfirm: true,
            showCancelButton : true,
            confirmButtonText : 'Yes'
            }).then(function() {

                // Append data.

                var data = { 'event_table' : table_data };

                // Ajax function

                $.ajax({

                    data :  data,
                    type : 'POST',
                    url : '<?php echo base_url("Events/save"); ?>',
                    crossOrigin : false,
                    dataType : 'json',
                    success : function(result) {

                        // Check whether input the data success or not.
                        if(result.status == "success") {
                            Swal.fire('Successfully Saved.','','success');
                        } else {
                            Swal.fire('Error.','','warning');
                        }
                    }

                })

            });
    });

});
</script>

<?php

    // Connect
    $db = mysqli_connect("localhost", "peter", "194221421942");
    mysqli_select_db($db, "login");

    // Receive data from DB and display in the user profile
    $email = isset($db, $_POST['email']);
    $username = isset($db, $_POST['username']);

    // Check if data is contained in the DB
    $userData = mysqli_query($db, "SELECT * FROM users WHERE username='$username'") or die("No query.");

    // Display user profile
    while($row = mysqli_fetch_array($userData)) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
    }

?>