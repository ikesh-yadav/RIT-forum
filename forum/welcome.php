<?php
  session_start();
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="common.css">
</head>
<body>
  <div style ="height: 5%;background-color: rgb(0, 0, 51);font-size:0px;">
    <div style="font-size: 30px;width: 100%;text-align: center;color:white"><b>Exam</b></div>
  </div>
<?php
  //values required to setup connect
  if(!isset($_SESSION['logged_in'])){
    header("Location: login.php");
    exit();
  }
  else {
    /*retrieve data from session*/
    $id=$_SESSION['id'];
    $nam=$_SESSION['username'];
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
    echo "WELCOME, ".$_SESSION['username'];
    /*displaying tests*/

    echo "<form action='logout.php' method='POST'><input type='submit' class='submitbtn' value='Log Out'/></form>";
    
    mysqli_close($link);
  }
?>
</body>
</html>

