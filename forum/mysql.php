<?php
    /*data for mysql connect*/
    $username = "root";
    $password = "";
    $server="localhost";
    $db_name="new_forum";
    /* connect to MySQL database */
    $link = mysqli_connect($server, $username, $password, $db_name);
    if (mysqli_connect_errno()){
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
?>