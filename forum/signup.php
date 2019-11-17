<?php
	if(isset($_POST['username'])){
        $username = "root";
        $password = "";
        $server="localhost";
        $db_name="new_forum";
        /*try to connect to MySQL database */
        $con = mysqli_connect($server, $username, $password, $db_name);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
		$name=trim($_POST['username']);
		$id=trim($_POST['id']);
		$password=trim($_POST['password']);
		$first_name=trim($_POST['first_name']);
		$last_name=trim($_POST['last_name']);
		$email=trim($_POST['email']);
		//$is_moderator=trim($_POST['is_moderator']);

			$sql = "INSERT INTO `user`(`id`, `username`, `password`, `first_name`,`last_name`,`email`) VALUES ('$id','$name','$password','$first_name','$last_name','$email')";
			if(mysqli_query($con,$sql)){
				echo "<script type='text/javascript'>alert('signup succesful');</script>";
				header("Location:login.php");
				die();
			}else{
				echo "<script type='text/javascript'>alert('signup unsuccesful');</script>";
				echo mysqli_error($con);
			}
		}

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="common.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div style ="height: 5%;background-color: rgb(0, 0, 51);font-size:0px;">
		<div style="font-size: 30px;width: 100%;text-align: center;color:white"><b>Forum</b></div>
	</div>
	<h2 style="text-align:center">Signup</h2>
	<form class="modal-content" method="post">
		<div class="container">
			<label for="id"><b>ID</b></label><input type="text" placeholder="Enter ID" name="id" required>
			<label for="username"><b>Username</b></label><input type="text" placeholder="Enter Username" name="username" required>
			<label for="password"><b>Password</b></label><input type="password" placeholder="Enter Password" name="password" required>
			<label for="first_name"><b>First Name</b></label><input type="text" placeholder="Enter your First Name" name="first_name" required>
			<label for="last_name"><b>Last Name</b></label><input type="text" placeholder="Enter your Last Name" name="last_name" required>
			<label for="email"><b>Email</b></label><input type="text" placeholder="Enter email" name="email" required>
			<!--<label for="is_moderator"><b>Moderator</b></label><input type="text" placeholder="Are you Faculty ?" name="is_moderator">-->
			
			<button type="submit">Signup</button>
			<a href="login.php"><input type="button" value="Login"></input></a> 
		</div>
	</form>
</body>
</html>