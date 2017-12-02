<?php
	$host = "mysql.idhostinger.com";
	$username = "u728140950_bot";
	$password = "V9B2GKT2bzap";
	$db_name = "u728140950_bot";

	$host_local = "localhost";
	$username_local = "root";
	$password_local = "";

	//$conn = new mysqli($host, $username, $password, $db_name);
	$conn = new mysqli($host_local, $username_local, $password_local, $db_name);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>