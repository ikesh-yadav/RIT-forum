<?php
  include_once('mysql.php');
  session_start();
  //var_dump($_SESSION);
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forum</title>
  <link rel="stylesheet" type="text/css" href="common.css">
</head>
<body>
<div id="topbar">
    <div id="title">
      <a href="index.html">
        <img src="msrit-logo.png" width=35px height=35px style="z-index:1;">
      </a>
      <h1>Forum</h1>
    </div>
    <nav class="menu">
      <ul>
        <li class="element"><a href="createThread.php">New thread</a></li>
        <li class="element"><img src="untitled.png" width="34vh" height="34vh" alt="image not found"></img>
          <ul>
            <li><a href="viewUser.php"><?php echo $_SESSION['username']?></a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
  <?php
  
  if(!isset($_SESSION['logged_in'])){
    header("Location: login.php");
    exit();
  }else{
    /*retrieve data from session*/
    $id=$_SESSION['id'];
    /*displaying categories*/
    echo '<div id="page-container">';
    echo '<div id="left-tab">';
    $sql = "SELECT name,id FROM category WHERE status=0";
      $result=$link->query($sql);
      echo '<table id="categories">';
      echo '<tr><td>categories</td></tr>';
      if ($result && $result->num_rows> 0) { 
        //output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr class='categoryLinks'><td>
            <form id=category".$row['id']." method='get' action='viewCategory.php'>
              <input type='hidden' name='categoryId' value='".$row['id']."'>
            </form>
            <a href='#' onclick='document.forms[\"category".$row['id']."\"].submit();'>".$row['name']."</a>
            </td></tr>";
        }
        mysqli_free_result($result);
      }else echo "<tr><td>No categories</td></tr>";
    echo "</table>";
    echo "</div>";
    /*displaying userss*/
    $sql = "SELECT username,id,created,last_activity,is_moderator,email FROM user WHERE status=0";
    $result=$link->query($sql);
    echo '<table id="UserView">';
    echo '<tr><td colspan=2>User Information</td></tr>';
    if ($result && $result->num_rows> 0) { 
    //output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>Username</td><td>
                ".$row['username']."
            </td></tr><tr><td>Id</td><td>
                ".$row['id']."
            </td></tr><tr><td>Joined</td><td>
                ".$row['created']."
            </td></tr><tr><td>Last Activity</td><td>
                ".$row['last_activity']."
            </td></tr>";
        if($_SESSION['id']===$row['id']) echo "</td></tr><tr><td>Email</td><td>".$row['email']."</td></tr>";
    }
    mysqli_free_result($result);
    }else echo "<tr><td>No Information for this user</td></tr>";
    echo "</table>";
    /*closing the connection to the mysql server created in the 'mysql.php' file*/
    mysqli_close($link);
  }
?>
</body>
</html>