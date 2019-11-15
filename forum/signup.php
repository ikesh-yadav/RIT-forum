<?php
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
		$id=trim($_POST['id']);
		$password=trim($_POST['psw']);
		$dob=trim($_POST['dob']);
		$department=trim($_POST['department']);
		$email=trim($_POST['email']);
		if(isset($_POST["faculty"])){
			$sql = "INSERT INTO `faculty`(`id`, `username`, `password`,`email`, `deparment`) VALUES ('$id','$name','$password','$email','$dob','$department')";
			if(mysqli_query($con,$sql)){
				echo "<script type='text/javascript'>alert('signup succesful');</script>";
				header("Location:login.php");
				die();
			}else{
				echo "<script type='text/javascript'>alert('signup unsuccesful');</script>";
			}
		}else{
			$semester=trim($_POST['semester']);
			$section=trim($_POST['section']);
			$sql = "INSERT INTO `student`(`id`, `username`, `password`, `dob`,`department`, `semester`,`section`,`email`) VALUES ('$id','$name','$password','$dob','$department','$semester','$section','$email')";
			if(mysqli_query($con,$sql)){
				echo "<script type='text/javascript'>alert('signup succesful');</script>";
				header("Location:login.php");
				die();
			}else{
				echo "<script type='text/javascript'>alert('signup unsuccesful');</script>";
				echo mysqli_error($con);
			}
		}
	}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="common.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
		function facultyCheck(){
			checkBox= document.getElementById('facultyCheckBox');
			if(checkBox.checked==true){
				document.getElementById('studentOnlyDetails').style.display="none";
			}else{
				document.getElementById('studentOnlyDetails').style.display="block";
			}
		}
	</script>
</head>
<body>
	<div style ="height: 5%;background-color: rgb(0, 0, 51);font-size:0px;">
		<div style="font-size: 30px;width: 100%;text-align: center;color:white"><b>Forum</b></div>
	</div>
	<h2 style="text-align:center">Signup</h2>
	<form class="modal-content" method="post">
		<div class="container">
			<label for="usn"><b>ID</b></label><input type="text" placeholder="Enter ID" name="id" required>
			<label for="uname"><b>Username</b></label><input type="text" placeholder="Enter Username" name="uname" required>
			<label for="email"><b>Email</b></label><input type="text" placeholder="Enter email" name="email" required>
			<label for="psw"><b>Password</b></label><input type="password" placeholder="Enter Password" name="psw" required>
			<label for="dob"><b>Date of Birth</b></label><input type="date" name="dob" required>
			<label for="department"><b>Department</b></label><input type="text" placeholder="Enter Department" name="department" required>
			<div id="studentOnlyDetails">
				<label for="section"><b>Section</b></label><input type="text" placeholder="Enter section" name="section" >
				<label for="semester"><b>Semester</b></label><input type="text" placeholder="Enter semester" name="semester">
			</div>
			<label><input type="checkbox" id="facultyCheckBox" name="faculty" onclick="facultyCheck()" unchecked>Faculty</label>
			<button type="submit">Signup</button>
			<a href="login.php"><input type="button" value="Login"></input></a> 
		</div>
	</form>
</body>
</html>