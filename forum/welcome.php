<?php
  include_once('mysql.php');
  session_start();
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Forum</title>
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
    /*Spliting the result into pages for easy viewing */
    if (!isset($_GET['page'])) $present_page_no = "1";
    else $present_page_no = $_GET['page'];
    $begin_position = $present_page_no - 1;
    $begin_position = $begin_position * $no_of_pages_per_page;
    /*MYSQL query */
    $sql = "SELECT id,subject,description,user_id,created,likes,dislikes FROM thread WHERE status=0";
    $result=$link->query("$sql LIMIT $begin_position,$no_of_pages_per_page");
    $all = $link->query("$sql");
    /*let's create visualization*/
    echo "<div class='content'>";
      echo "<div class='content-container'>";
        echo "<div class='thread-list-container'>";
          echo "<table class='thread-list-table'>";
            echo "<tr><td colspan='7'><strong>Threads</strong></td></tr>";
      if ($result && $result->num_rows> 0) { 
        /*list the result if found*/
        while($row = $result->fetch_assoc()) {
            echo "<tr class='thread-links-list'>
                  <td width='90%'>
                    <a href='#' class='links' onclick='document.forms[\"thread-".$row['id']."\"].submit();'>
                      <form id='thread-".$row['id']."' method='get' action='viewThread.php'>
                        <input type='hidden' name='thread_Id' value='".$row['id']."'>
                      </form>
                      <table class='thread-link-table'>
                        <tr>
                          <td>
                            ".$row['subject']."
                          </td>
                        </tr>
                        <tr>
                          <td>
                            ".$row['description']."
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Created at: ".$row['created']." by ".$row['user_id']."
                          </td>
                        </tr>
                      </table>
                    </a>
                  </td>
                  <td width='10%'>  
                    <table class='thread-likes-dislikes-table'>
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
        mysqli_free_result($result);
      }else echo "<tr><td>No Threads</td></tr>";
      echo "</table>";
      if($all){
        $total_no_of_rows = $all->num_rows; /* checks the total number of records*/
        $total_no_of_pages = $total_no_of_rows / $no_of_pages_per_page; /* checks the total number of pages*/

        /* now let's create the "Previous and next buttons"*/
        $previous = $present_page_no -1;
        $next = $present_page_no +1;
        if($present_page_no>1) echo "<a class='links-with-buttons' href='?page=$previous'><input type='button'value='<- Previous page'></a> ";        
        if($present_page_no<$total_no_of_pages) echo "<a class='links-with-buttons' href='?page=$next'><input type='button'value='Next page ->'></a>";
      }
      echo "</div>";/*closing thread-list-container div*/
      echo "</div>";/*closing content-container div*/
      echo "</div>";/*cclosing content div */
      /*closing the connection to the mysql server created in the 'mysql.php' file*/
    mysqli_close($link);
  }
?>
</body>
</html>

