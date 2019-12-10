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
  <script>
    function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("categoryHint").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "tagCategory.php?category="+str, true);
        xmlhttp.send();
    }
}
  </script>
</head>
</head>
<body>
<div class="topbar">
    <div id="title">
      <a href="welcome.php">
        <img src="msrit-logo.png">
        <span id="title-name">Forum</span>
      </a>
    </div>
    <div class="extra-content">
      <a href="viewCategory.php">

      </a>
    </div>
    <nav class="menu">
      <ul>
        <li class="element"><a id="plusIcon" href="createThread.php">+</a></li>
        <li class="element"><button class="stock-buttons"><img src="user-icon.png" width="30px" height="30px" alt="image not found"></img></button>
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
  }
  if(isset($_SESSION['logged_in']) and isset($_POST['title']) and isset($_POST['subject']) and isset($_POST['categoryList'])){
    $sql="INSERT into `thread` (`subject`,`description`,`user_id`) values ('".$_POST['title']."','".$_POST['subject']."',".$_SESSION['id'].");";
    $result=$link->query($sql);
    if($result) {
      echo "<script>alert('Thread created succesfully')</script>";
      //sleep(10);
      header("Location: welcome.php");
      exit();
    }
  }
  ?>
  <div class="content">
      <div class="add-thread-container">
        <form method="post">
          <table>
            <tr><td>
              <label><b>New thread</b></label>
            </tr></td>
            <tr><td>
              <input type="text" class="q" placeholder="Enter Title" name="title" required >
            </td></tr>
            <tr><td>
              <textarea class="q" placeholder="Enter Subject" name="subject" rows="15" required></textarea>
            </td></tr>
            <tr><td>
              <input type = "text"  placeholder="Enter catergory" onkeyup="showHint(this.value)" class="q" name="categoryList">
              <p>Suggestions: <span id="categoryHint"></span></p>
            </td></tr>
            <tr><td>
              <button type="submit" class="q" onclick="">Create</button>
            </td></tr>
          </table>
        </form>
      </div> 
  </div> 
</body>
</html>