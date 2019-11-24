<?php
  include_once('mysql.php');
  session_start();
  /*var_dump($_POST);
  var_dump($_SESSION);*/
?>
<html>
<head>
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
  //values required to setup connect
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
    /*displaying threads*/
    $sql = "SELECT `id`,`subject`,`created`,`user_id`,`likes`,`dislikes` FROM thread WHERE status=0";
    $result=$link->query($sql);
    echo '<div id="content">';
    echo '<table id="conetnt-tab">';
    echo '<tr><td>Threads</td></tr>';
    if ($result && $result->num_rows> 0) { 
    //output data of each row
    while($row = $result->fetch_assoc()) {
        
        echo "<tr><td>".$row['id']."<br>".$row['subject']."<br>".$row['created']."<br>".$row['user_id']."<br>".$row['likes']."<br>".$row['dislikes']."<br>"."</td></tr>";
    }
    mysqli_free_result($result);
    }else echo "<tr><td>Thread not found!</td></tr>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    
    mysqli_close($link);
  }
?>
</body>
</html>