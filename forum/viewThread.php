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
  <script type="text/javascript" src="jquery.js"></script>
  <script>
    $(document).ready(function() {
    $('.like-container').click(function(e) {
        console.log("entered ajax code");
        var post_id=this.firstElementChild.getAttribute('value');
        $.ajax({
            type: 'POST',
            url: 'like-post.php',
            data: {
                user_id: <?php echo $_SESSION['id'] ?>,
                post_id: this.firstElementChild.getAttribute('value'),
                is_like:1
            },
            dataType: 'text',
            success: function(data) {
                // do whatever here
                if(data === 'success') {
                  var count = parseInt($('#like-dislike-count'+post_id).text());
                  $('#like-dislike-count'+post_id).text(count+1);
                    //console.log('Updated succeeded');
                } else {
                    console.log(data); // perhaps an error message?
                }
               
            }
        });
    });
    $('.dislike-container').click(function(e) {
        console.log("entered ajax code");
        var post_id=this.firstElementChild.getAttribute('value');
        $.ajax({
            type: 'POST',
            url: 'like-post.php',
            data: {
                user_id: <?php echo $_SESSION['id'] ?>,
                post_id: this.firstElementChild.getAttribute('value'),
                is_like:0
            },
            dataType: 'text',
            success: function(data) {
                // do whatever here
                if(data === 'success') {
                  var count = parseInt($('#like-dislike-count'+post_id).text());
                  $('#like-dislike-count'+post_id).text(count-1);
                  //console.log('Updated succeeded');
                } else {
                    console.log(data); // perhaps an error message?
                }
            }
        });
    });
  });
  </script>
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
  echo "<script> console.log('PHP:started');</script>";
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
      $sql2="SELECT `id`,`content` ,`created`,`user_id`,`likes`,`dislikes` FROM `post` WHERE `thread_id`=".$_GET['thread_Id']." and status=0";
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
                          <div class='like-container'>
                            <input type='hidden' class='hidden-field' value='".$row['id']."'>
                            <img src='upward-arrow.png' width='30px' height='30px'>
                            ";
                        $query_likes="Select likes from `post_view_like` where `post_id`=".$row['id']."";
                        $result_of_likes=$link->query($query_likes);
                        $likes_row=$result_of_likes->fetch_assoc();
                        $query_dislikes="Select dislikes from `post_view_dislikes` where `post_id`=".$row['id']."";
                        $result_of_dislikes=$link->query($query_dislikes);
                        $dislikes_row=$result_of_dislikes->fetch_assoc();
                        echo  "</div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div id='like-dislike-count".$row['id']."'>
                          ".((int)$likes_row['likes']-(int)$dislikes_row['dislikes'])."
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                        <div class='dislike-container'>
                          <input type='hidden' class='hidden-field' value='".$row['id']."'>
                          <img src='downward-arrow.png' width='30px' height='30px'>
                        </div>
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