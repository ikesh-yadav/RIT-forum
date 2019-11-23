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
    header("Location: login.php");
    exit();
  }else{
    /*retrieve data from session*/
    $id=$_SESSION['id'];
    /*displaying categories*/
    $sql = "SELECT name,id FROM category WHERE status=0";
      $result=$link->query($sql);
      echo '<table id="categories">';
      echo '<tr><td>categories</td></tr>';
      if ($result && $result->num_rows> 0) { 
        //output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>
            <form id=category".$row['id']." method='get' action='viewCategory.php'>
              <input type='hidden' name='categoryId' value='".$row['id']."'>
            </form>
            <a href='#' onclick='document.forms[\"category".$row['id']."\"].submit();'>".$row['name']."</a>
            </td></tr>";
        }
        mysqli_free_result($result);
      }else echo "<tr><td>No categories</td></tr>";
      echo "</table>";
    /*closing the connection to the mysql server created in the 'mysql.php' file*/
    mysqli_close($link);
  }
?>
</body>
</html>

