<?php
  session_start();
  include_once('mysql.php');
  var_dump($_POST);
  var_dump($_SESSION);
?>
<html>
<head>
  <title>Forum users list</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="common.css">
</head>
<body>
  <div style ="height: 5%;background-color: rgb(0, 0, 51);font-size:0px;">
    <div style="font-size: 30px;width: 100%;text-align: center;color:white"><b>Forum</b></div>
  </div>
<?php
  /*if(!isset($_SESSION['logged_in'])){
    header("Location: login.php");
    exit();
  }else{
    */
    /*displaying categories*/
    $sql = "SELECT name,id FROM category WHERE status=0";
    $result=$link->query($sql);
    echo '<div id="page-container">';
    echo '<div id="left-tab">';
    echo '<ul id="categories-tab">';
    echo '<li>categories</li>';
    if ($result && $result->num_rows> 0) { 
    //output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<li><form id=category".$row['id']." method='get' action='viewCategory.php'><input type='hidden' name='categoryId' value='".$row['id']."'></form><a href='#' onclick='document.forms['category".$row['id']."].submit();'>".$row['name']."</a></li>";
    }
    mysqli_free_result($result);
    }else echo "<tr><td>No categories</td></tr>";
    echo "</table>";
    echo "</div>";
    /*displaying users*/
    $sql = "SELECT username,picture,first_name,created,id,last_activity FROM user WHERE status=0";
    echo '<div id="content">';
    echo '<table id="categories-tab">';
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
        echo "<tr><td>";
        if($row['picture']!=null) echo '<img width="40" height="40" src="data:image/jpeg;base64,'.base64_encode( $row['picture'] ).'"/>';
        else echo '<img width="40" height="40" src="user-icon.jpeg"/>';
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
            </td></tr>";
    }
    mysqli_free_result($result);
    }else echo "<tr><td>No Users</td></tr>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "<form action='logout.php' method='POST'><input type='submit' class='submitbtn' value='Log Out'/></form>";
    
    mysqli_close($link);
  //}
?>
</body>
</html>