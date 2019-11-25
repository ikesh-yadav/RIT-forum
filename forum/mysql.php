<?php
    /*data for mysql connect*/
    $username = "root";
    $password = "";
    $no_of_pages_per_page = "10";
    $server="localhost";
    $db_name="new_forum";
    /* connect to MySQL database */
    $link = mysqli_connect($server, $username, $password, $db_name);
    if (mysqli_connect_errno()){
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    function setLastActivity(){
        global $link;
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('asia/kolkata'));
        $sql="UPDATE `user` set `last_activity`='".$now->format('Y-m-d H:i:s')."' WHERE id=".$_SESSION['id'].";";
        mysqli_query($link, $sql);
    }
?>