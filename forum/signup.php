<!DOCTYPE html>
<?php
	include_once('mysql.php');
	if(isset($_POST['username'])){
		
		$name=trim($_POST['username']);
		$id=trim($_POST['id']);
		$password=trim($_POST['password']);
		$first_name=trim($_POST['first_name']);
		$last_name=trim($_POST['last_name']);
		$email=trim($_POST['email']);
		//$is_moderator=trim($_POST['is_moderator']);

			$sql = "INSERT INTO `user`(`id`, `username`, `hashed_password`, `first_name`,`last_name`,`email`) VALUES ('$id','$name','$password','$first_name','$last_name','$email')";
			if(mysqli_query($link,$sql)){
				echo "<script type='text/javascript'>alert('signup succesful');</script>";
				header("Location:login.php");
				die();
			}else{
				echo "<script type='text/javascript'>alert('signup unsuccesful');</script>";
				echo mysqli_error($link);
			}
		}

?>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>Forum | RIT</title>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
	<link rel="icon" href="https://upload.wikimedia.org/wikipedia/en/thumb/5/5a/Ramaiah_Institutions_Logo.png/220px-Ramaiah_Institutions_Logo.png">
</head>
<body>
	<div class="wrapper">
		<div class="header" id="over">
		<img id="iover" class="ititle" src="msrit-logo.png" alt="msrit"/>
		<p id="iover" class="mtitle"><b>RIT FORUM</b></p>
		<br style="clear: both;">
		</div>
		
		<form class="signup" method="post">
			<h2 style="text-align:center">Signup</h2>
					<input type="text" placeholder="Enter ID" name="id" required>
					<input type="text" placeholder="Enter Username" name="username" required>
					<input type="password" placeholder="Enter Password" name="password" required>
					<input type="text" placeholder="Enter your First Name" name="first_name" required>
					<input type="text" placeholder="Enter your Last Name" name="last_name" required>
					<input type="text" placeholder="Enter email" name="email" required>

					<button type="submit">Signup</button>
					<button type="submit" onclick="myFunction()">Login</button>
					<script>
						function myFunction() {
							window.location="login.php";
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