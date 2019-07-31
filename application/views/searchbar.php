<?php

    // Ajax function for getting data from DB
    if(!empty($_GET['q'])) {
        // Connect
        $db = mysqli_connect("localhost", "peter", "194221421942");
        mysqli_select_db($db, "search");

        // Departures unique characters in a string for use in an SQL statement
        $q = mysqli_real_escape_string($db, $_GET['q']);

        // Check %$q% whether contained in the DB
        $query = "SELECT * FROM category WHERE name LIKE '%$q%'";
        $result = mysqli_query($db, $query);


        // Get an outcome row to an asssociative array
        while($output = mysqli_fetch_assoc($result)) {
            // Lower Case
            $link = lcfirst($output['name']);
            echo '<a href="'.$link.'.php">'.$output['name'].'</a>';
        }
    }

?>