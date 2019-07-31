<?php

    if(!empty($_GET['q'])) {
        // Connect
        $db = mysqli_connect("localhost", "peter", "194221421942");
        mysqli_select_db($db, "search");

        $q = mysqli_real_escape_string($db, $_GET['q']);

        $query = "SELECT * FROM caterology WHERE name LIKE '%$q%'";
        $result = mysqli_query($db, $query);



        while($output = mysqli_fetch_assoc($result)) {
            echo '<a href="">'.$output['name'].'</a>';
        }
    }

?>