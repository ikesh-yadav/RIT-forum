<!DOCTYPE html>
<?php
  include_once('mysql.php');
  session_start();
  /*unsetting loging unsuccessful message variable */
  if(isset($_SESSION['login_data'])){unset($_SESSION['login_data']);}
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="common.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
	echo var_dump($_SESSION);
	$login_status="";
    if(isset($_SESSION['logged_in'])){
      header("Location: welcome.php");
      die();
    }
    else{
      if(isset($_POST['id']) && isset($_POST['password'])){
        
        $id=trim($_POST['id']);
        $pass=trim($_POST["password"]);

      
        $query = "SELECT username,hashed_password FROM user WHERE id='".$id."'";
        /* Execute the statement */
        if ($result = mysqli_query($link, $query)) {
          $row = mysqli_fetch_row($result);
          $nam=$row[0];
          $retrevied_password=$row[1];
          /* free result set */
          mysqli_free_result($result);
        }
        else {
          printf("Error: %s.\n", mysqli_error($link));
        }
        
        /*setting common session data*/
        $_SESSION['id']=$id;
        $_SESSION['username']=$nam;
        /*checking password*/
        if($retrevied_password==$pass){
          $_SESSION['logged_in']=true;
          header("Location: welcome.php");
          exit();
        }
        else{
          $login_status="Login unsuccesful";
        }
      }
    }
  ?>
</head>
<body>
<div style ="height: 5%;background-color: rgb(0, 0, 51);font-size:0px;">
  <div style="font-size: 30px;width: 100%;text-align: center;color:white"><b>RIT FORUM</b></div>
</div>
<h2 style="text-align:center">Login</h2>
  <form class="modal-content" method="post">
    <div class="container">
      <label for="id"><b>ID</b></label>
      <input type="text" placeholder="Enter id" name="id" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <button type="submit">Login</button>
	    <a href="signup.php"><input type="button" value="Signup"></input></a>
      <div style="text-align:center"><?php $login_status?></div>
    </div>
    
  </form>
</body>
</html>