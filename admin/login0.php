<?php
	session_start();
	//Include db connection file
	include("../dbconn.php");

	if (isset($_POST['login_user'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
	}

	$sql = "SELECT * FROM admin WHERE admin_username = '$username'
	AND admin_password = '$password'
	";

	//Execute query
	$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
	$row = mysqli_num_rows($query);

	//Count rows to check if user exists
	if($row == 0){
		echo "Invalid Username/Password. Click here to <a href='login.php'>login</a>.";
	}
	else{
		$r = mysqli_fetch_assoc($query);
		$_SESSION['admin_username'] = $r['admin_username'];
		header("Location: index.php");
	}
?>