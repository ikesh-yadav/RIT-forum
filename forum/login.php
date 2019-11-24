<!DOCTYPE html>
<?php
  include_once('mysql.php');
  session_start();

?>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style2.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
  <title>Forum | RIT</title>
  <?php
	//echo var_dump($_SESSION);
	$login_status="";
    if(isset($_SESSION['logged_in'])){
      header("Location: welcome.php");
      die();
    }else{
      if(isset($_POST['id']) && isset($_POST['password'])){
        /*retrieve data from the loginn form */
        $id=trim($_POST['id']);
        $pass=trim($_POST["password"]);
        /*sql query */
        $query = "SELECT username,hashed_password FROM user WHERE id='".$id."'";
        /* Execute the statement */
        if ($result = mysqli_query($link, $query)) {
          $row = mysqli_fetch_row($result);
          $nam=$row[0];
          $retrevied_password=$row[1];
          /* free result set */
          mysqli_free_result($result);
        }else{
          printf("Error: %s.\n", mysqli_error($link));
        }
              
        /*checking password*/
        if($retrevied_password==$pass){
          /*setting common session data*/
          $_SESSION['logged_in']=true;
          $_SESSION['id']=$id;
          $_SESSION['username']=$nam;
          header("Location: welcome.php");
          exit();
        }
        else{
          $login_status="Login unsuccessful, Try Again!";
        }
      }
    }
  
  ?>
  <link rel="icon" href="https://upload.wikimedia.org/wikipedia/en/thumb/5/5a/Ramaiah_Institutions_Logo.png/220px-Ramaiah_Institutions_Logo.png">
</head>
<body>
  -->
  <div class="wrapper"> 
    <div class="header" id="over">
        <img id="iover" class="ititle" src="msrit-logo.png" alt="msrit"/>
        <p id="iover" class="mtitle"><b>RIT FORUM</b></p>
        <br style="clear: both;">
    </div>
   
    <form class="login" method="post">
        <h2 style="text-align:center">LOGIN</h2>
        <input type="text" placeholder="Enter ID" name="id" required>
        <input type="password" placeholder="Enter Password" name="password" required>
        <button type="submit">Login</button>
        <button type="submit" onclick="myFunction()">Signup</button>
        <div id="login-status"><?php echo $login_status?></div>
        <script>
          function myFunction() {
            window.location="signup.php";
          }
        </script>
    </form>
  </div>

  <div>
    <footer class="footer">
      <div class="mfooter">
          <p> <a href='#' onclick='window.open("http://www.msrit.edu"); return false;'>MSRIT</a> </p>
      </div>
    </footer>
  </div>
  
</body>
</html>