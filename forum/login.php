<!DOCTYPE html>
<?php
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
    }else{
      if(isset($_POST['usn']) && isset($_POST['psw'])){
        $username = "root";
        $password = "";
        $server="localhost";
        $db_name="forum";
        /*trying to connect to MySQL database */
        $link = mysqli_connect($server, $username, $password, $db_name);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $id=trim($_POST['usn']);
        $pass=trim($_POST["psw"]);
        if(isset($_POST["faculty"])){
          /*if the login user is a faculty*/
          $faculty=1;
          $query = "SELECT username,password FROM faculty WHERE id='".$id."'";
          /* Execute the statement */
          if ($result = mysqli_query($link, $query)) {
            $row = mysqli_fetch_row($result);
            $nam=$row[0];
            $retrevied_password=$row[1];
            /* free result set */
            mysqli_free_result($result);
          }
          else{
            printf("Error: %s.\n", mysqli_error($link));
          }
        }else{
          /*if the login user is a student*/
          $faculty=0;
          $query = "SELECT username,password FROM student WHERE id='".$id."'";
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
        }
        /*setting common session data*/
        $_SESSION['faculty'] = $faculty;
        $_SESSION['id']=$id;
        $_SESSION['name']=$nam;
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
  <div style="font-size: 30px;width: 100%;text-align: center;color:white"><b>Exam</b></div>
</div>
<h2 style="text-align:center">Login</h2>
  <form class="modal-content" method="post">
    <div class="container">
      <label for="usn"><b>USN</b></label>
      <input type="text" placeholder="Enter USN" name="usn" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
      <label>
        <input type="checkbox" name="faculty" unchecked> Faculty
      </label>
      <button type="submit">Login</button>
	  <a href="signup.php"><input type="button" value="Signup"></input></a>
      <div style="text-align:center"><?php $login_status?></div>
    </div>
    
  </form>
</body>
</html>