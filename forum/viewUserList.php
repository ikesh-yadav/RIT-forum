<?php
  session_start();
  var_dump($_POST);
  var_dump($_SESSION);
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="common.css">
</head>
<body>
  <div style ="height: 5%;background-color: rgb(0, 0, 51);font-size:0px;">
    <div style="font-size: 30px;width: 100%;text-align: center;color:white"><b>Forum</b></div>
  </div>
<?php
  //values required to setup connect
  /*if(!isset($_SESSION['logged_in'])){
    header("Location: login.php");
    exit();
  }else{
    */
    /*retrieve data from session*/
    if(isset($_SESSION['id'])){$id=$_SESSION['id'];echo "WELCOME, ".$username; }else $id="ANONYMOUS";
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
    /*displaying categories*/
    $sql = "SELECT id,name FROM category WHERE status=0";
    $result=$link->query($sql);
    echo '<div id="page-container">';
    echo '<div id="left-tab">';
    echo '<table id="categories-tab">';
    echo '<tr><td>categories</td></tr>';
    if ($result && $result->num_rows> 0) { 
    //output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<td><form id=category".$row['id']." method='get' action='viewCategory.php'><input type='hidden' name='categoryId' value='".$row['id']."'></form><a href='#' onclick='document.forms['category".$row['id']."].submit();'>".$row['name']."</a></td></tr>";
    }
    mysqli_free_result($result);
    }else echo "<tr><td>No categories</td></tr>";
    echo "</table>";
    echo "</div>";
    /*displaying threads*/
    $sql = "SELECT `id`,`first_name`,`last_name`,`created`,`email` FROM user WHERE status=0";
    $result=$link->query($sql);
    echo '<div id="content">';
    echo '<table id="conetnt-tab">';
    echo '<tr><td>Users</td></tr>';
    if ($result && $result->num_rows> 0) { 
    //output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "<td><form id=category".$row['id']." method='post' action='viewCategory.php'><input type='hidden' name='categoryId' value='".$row['id']."'></form><a href='#' onclick='document.forms['category".$row['id']."].submit();'>".$row['name']."</a></td></tr>";
        echo "<tr><td><form id=user".$row['id']." method='get' action='viewUser.php'><input type='hidden' name='userId' value='".$row['id']."'></form><a href='#' onclick='document.forms[\"user".$row['id']."\"].submit();'>".$row['id']."<br>".$row['first_name']."<br>".$row['last_name']."<br>".$row['email']."<br>".$row['created']."<br></a></td></tr>";
    }
    mysqli_free_result($result);
    }else echo "<tr><td>No categories</td></tr>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "<form action='logout.php' method='POST'><input type='submit' class='submitbtn' value='Log Out'/></form>";
    
    mysqli_close($link);
  //}
?>
</body>
</html>