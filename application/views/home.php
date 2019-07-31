<head>
    <script src="<?php echo base_url();?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/javascript.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6tJnA80O001ohepXTGKjPsS59tBdFs-0&callback=initMap"></script>
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

<div class="caption text-center">
    <h1>It's time to host an event by yourself !</h1>
    <h3>Create your own event to your friend and have fun with them !</h3>
    <div class="pad">
        <a class="btn btn-outline-light bgc1 btn-lg" href="#create">Create Event</a>
        <a class="btn btn-outline-light bgc2 btn-lg" href="#intro">Learn More</a>
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
        </div>
    </div>
</div>