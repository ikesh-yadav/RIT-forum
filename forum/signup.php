<?php
	/* ikesh and himan are bosses*/
	if(isset($_POST['uname'])){
        $username = "root";
        $password = "";
        $server="localhost";
        $db_name="forum";
        /*try to connect to MySQL database */
        $con = mysqli_connect($server, $username, $password, $db_name);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
		$name=trim($_POST['uname']);
		$usn=trim($_POST['usn']);
		$password=trim($_POST['psw']);
		$dob=trim($_POST['dob']);
		$department=trim($_POST['department']);
		$sql = "INSERT INTO `users`(`usn`, `name`, `password`, `deparment`, `dob`) VALUES ('$usn','$name','$password','$department','$dob')";
		if(mysqli_query($con,$sql)){
			echo "<script type='text/javascript'>alert('signup succesful');</script>";
			header("Location:login.php");
			die();
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
			<label for="usn"><b>USN</b></label><input type="text" placeholder="Enter USN" name="usn" required>
			<label for="uname"><b>Username</b></label><input type="text" placeholder="Enter Username" name="uname" required>
			<label for="psw"><b>Password</b></label><input type="password" placeholder="Enter Password" name="psw" required>
			<label for="dob"><b>Date of Birth</b></label><input type="date" name="dob" required>
			<label for="department"><b>Department</b></label><input type="text" placeholder="Enter Department" name="department" required>
			<label><input type="checkbox" name="faculty" unchecked> Faculty</label>
			<button type="submit">Signup</button>
			<a href="login.php"><input type="button" value="Login"></input></a> 
		</div>
	</form>
</body>
</html>