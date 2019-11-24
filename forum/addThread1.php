<!DOCTYPE html>
<?php
  session_start();
  include_once('mysql.php');
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forum</title>
  <link rel="stylesheet" type="text/css" href="common.css">
</head>
<style>
.q {
  font-variant: normal;
  font-weight: bold;
  margin: 0 auto;
  display: block;
  width: 800px;
  size:70;
  padding:20px;
}
</style>
</head>
<body>
  <div id="topbar">
    <div id="title">
      <a href="welcome.php">
        <img src="msrit-logo.png">
        <span id="title-name">Forum</span>
      </a>
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
  }
  ?>
<div class="content">
<form method="post">
	</br></br></br></br></br>
      <input type="text" class="q" placeholder="Enter Title" name="title" required >
	</br></br>
  <input type="text" class="q" placeholder="Enter Subject" name="sub" required>
  </br></br>

	 <p class="q">Select Category:</p>
      <input type = "text" class="q" list = "cats" name="cats">
      <datalist id = "cats">
        <option value = "a">
        <option value = "b">
        <option value = "c">
        <option value = "d">
      </datalist>
      </br><br>
      <button type="submit" class="q" onclick="">Create</button>
</div> 
</div> 
</body>
</html>