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
<?php
  echo '<div id="header" style ="height:5%;width:100%;background-color: rgb(0, 0, 51);font-size:0px;">';
  echo '<div id="title" style="width:100%;text-align:center;color:white"><b>Forum</b></div>';
  echo '<div id="navigation" style="width:100%;"><span style="font-size:15px;float:right;">WELCOME, '.$_SESSION['username'].'</span></div>';
  echo '</div>';

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
          echo "<td><form id=category".$row['id']." method='get' action='viewCategory.php'><input type='hidden' name='categoryId' value='".$row['id']."'></form><a href='#' onclick='document.forms[\"category".$row['id']."\"].submit();'>".$row['name']."</a></td></tr>";
        }
        mysqli_free_result($result);
      }else echo "<tr><td>No categories</td></tr>";
      echo "</table>";

    echo "<form action='logout.php' method='POST'><input type='submit' class='submitbtn' value='Log Out'/></form>";
    
    mysqli_close($link);
  }
?>
</body>
</html>

