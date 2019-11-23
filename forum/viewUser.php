<?php
  include_once('mysql.php');
  session_start();
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forum</title>
  <link rel="stylesheet" type="text/css" href="common.css">
</head>
<body>
<div class="flex-container">

  <div id="header">
    <h1>Forum</h1>
    <div id="navigation">
      <div id="createThreadButton"><a href="createThread.php">Create Thread</a></div>
      <div id="navigationButton"><?php echo $_SESSION['username']?>
        <ul>
          <li><a href="viewUser.php">Acccount Information</a></li>
          <li><a href="logout">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
  <?php
  //values required to setup connect
  if(!isset($_SESSION['logged_in'])){
    
  }else{
    /*retrieve data from session*/
    $id=$_SESSION['id'];
    /*displaying categories*/
    $sql = "SELECT username,id,created,last_activity,is_moderator FROM user WHERE status=0";
    $result=$link->query($sql);
    echo '<table id="UserView">';
    echo '<tr><td>User Information</td></tr>';
    if ($result && $result->num_rows> 0) { 
    //output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>Username:
                ".$row['username']."
            </td></tr><tr><td>Id:
                ".$row['id']."
            </td></tr><tr><td>Joined:
                ".$row['created']."
            </td></tr><tr><td>Last Activity
                ".$row['last_activity']."
            </td></tr>";
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