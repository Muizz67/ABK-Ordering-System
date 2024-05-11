<?php
	/* php& mysqldb connection file */
	$username = "root"; //mysqlemail
	$password = ""; //mysqlpassword
	$host = "localhost"; //server name or ipaddress
	$dbname= "abk"; //your db name

	$dbconn= mysqli_connect($host, $username, $password, $dbname) or die(mysqli_error($dbconn));
?>