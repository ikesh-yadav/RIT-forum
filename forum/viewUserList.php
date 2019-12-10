<?php
  session_start();
  include_once('mysql.php');
  /*var_dump($_POST);
  var_dump($_SESSION);*/
?>
<html>
<head>
  <title>Forum users list</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="common.css">
</head>
<body>
  <div id="topbar">
    <div id="title">
      <a href="index.html">
        <img src="msrit-logo.png" width=35px height=35px style="z-index:1;">
      </a>
      <span id="title-name">Forum</span>
    </div>
    <nav class="menu">
      <ul>
        <li class="element"><a id="plusIcon" href="createThread.php">+</a></li>
        <li class="element"><img src="user-icon.png" width="34vh" height="34vh" alt="image not found"></img>
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
      echo '<div class="left-tab">';
      $sql = "SELECT name,id FROM category WHERE status=0";
      $result=$link->query($sql);
      echo '<table class="categories-table">';
      echo '<tr><td><strong>categories</strong></td></tr>';
      if ($result && $result->num_rows> 0) { 
        //output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr class='categoryLinks'><td>
            <form id=category-".$row['id']." method='get' action='viewCategory.php'>
              <input type='hidden' name='category_Id' value='".$row['id']."'>
            </form>
            <a href='#' onclick='document.forms[\"category-".$row['id']."\"].submit();'>".$row['name']."</a>
            </td></tr>";
        }
        mysqli_free_result($result);
      }else echo "<tr><td>No categories</td></tr>";
      echo "</table>";
      echo "</div>";
        /*displaying users*/
        $sql = "SELECT username,picture,first_name,created,id,last_activity FROM user WHERE status=0";
        echo '<div id="content">';
        echo "<div class='users-list-container'>";
        echo "<table id='categories-tab'>";
        echo "<tr><td>picture</td>
                <td>Username</td>
                <td>first_name</td>
                <td>Id</td>
                <td>Joined</td>
                <td>Last Activity</td>
              </tr>";
        $result=$link->query($sql);
        if ($result && $result->num_rows> 0) { 
          //output data of each row
          while($row = $result->fetch_assoc()) {
            echo "<tr class='userLinks'><td><a href='#' onclick='document.forms[\"user-".$row['id']."\"].submit();'>
            <form id='user-".$row['id']."' method='get' action='viewUser.php'>
              <input type='hidden' name='User_to_view' value='".$row['id']."'>
            </form>";
            if($row['picture']!=null) echo '<img width="40" height="40" src="data:image/jpeg;base64,'.base64_encode( $row['picture'] ).'">';
            else echo '<img  width="40" height="40" style="background-color: #0084ff;" src="user-icon.png">';
            echo "</td><td>
                    ".$row['username']."
                </td><td>
                    ".$row['first_name']."
                </td><td>
                    ".$row['id']."
                </td><td>
                    ".$row['created']."
                </td><td>
                    ".$row['last_activity']."
                </td></tr></a>";
          }
        mysqli_free_result($result);
        }else echo "<tr><td>No Users</td></tr>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        /*closing the connection to the mysql server created in the 'mysql.php' file*/
        mysqli_close($link);
    }
  ?>
</body>
</html>