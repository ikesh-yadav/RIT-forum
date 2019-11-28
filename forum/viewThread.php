<?php
  include_once('mysql.php');
  session_start();
  /*var_dump($_GET);
  var_dump($_SESSION);*/
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="common.css">
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
  if(isset($_POST['post_textarea'])){
    if(isset($_SESSION['logged_in'])){
      $sql="INSERT INTO `post`(`content`,`thread_id`, `user_id`) VALUES ('".$_POST['post_textarea']."',".$_GET['thread_Id'].",".$_SESSION['id'].");";
      $result=$link->query($sql);
       unset($_POST['post_textarea']);
    }
  }
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
    /*displaying threads*/
    $sql1 = "SELECT `id`,`subject`,`created`,`user_id`,`likes`,`dislikes` FROM thread WHERE id='".$_GET['thread_Id']."' and status=0";
    $result1=$link->query($sql1);
    echo "<div class='content'>";
      echo "<div class='content-container'>";
        echo "<div class='thread-view-container'>";
          echo "<table class='thread-view-table'>";
            
    if ($result1 && $result1->num_rows> 0) { 
      /*output data of the thread*/
          echo '<tr><td>Thread</td></tr>';
      while($row = $result1->fetch_assoc()) {
          echo "<tr><td>".$row['id']."<br>".$row['subject']."<br>".$row['created']."<br>".$row['user_id']."<br>".$row['likes']."<br>".$row['dislikes']."<br>"."</td></tr>";
      }
      echo "</table>";
      echo "<table class='post-list-table'>";
      mysqli_free_result($result1);
      /*Query to retrieve the posts related to a thread */
      $sql2="SELECT `content` ,`created`,`user_id`,`likes`,`dislikes` FROM `post` WHERE `thread_id`=".$_GET['thread_Id']." and status=0";
      $result2=$link->query($sql2);
      if ($result2 && $result2->num_rows> 0) { 
        /*list the result if found*/
        while($row = $result2->fetch_assoc()) {
            echo "<tr class='thread-posts-list'>
                  <td width='90%'>
                      <table class='post-content-table'>
                        <tr>
                          <td>
                            ".$row['content']."
                          </td>
                        </tr>
                        <tr>
                          <td>
                            posted at: ".$row['created']." by ".$row['user_id']."
                          </td>
                        </tr>
                      </table>
                    </a>
                  </td>
                  <td width='10%'>  
                    <table class='post-likes-dislikes-table'>
                      <tr>
                        <td>
                          <img src='upward-arrow.png' width='30px' height='30px'>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          ".((int)$row['likes']-(int)$row['dislikes'])."
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <img src='downward-arrow.png' width='30px' height='30px'>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>";     
                }
              mysqli_free_result($result2);
              }else{
                echo "<tr><td>No posts for this thread</td></tr>";
              }
              echo "<tr class='add-post'>
                      <form method='post'>
                        <table>
                          <tr>
                            <td>
                              <textarea class='' rows='10' name='post_textarea'></textarea>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <input type='submit'>
                            </td>
                          </tr>
                        </table>
                      </form>
                    </tr>";
    }else echo "<tr><td>Thread  not found!</td></tr>";
    echo "</table>";
    echo "</div>";
    echo "</div>";   
  }
  mysqli_close($link);
?>
</body>
</html>