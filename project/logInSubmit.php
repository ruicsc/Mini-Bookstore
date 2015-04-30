<?php

	$user = $_POST['username'];
	$userpassword = $_POST['password'];
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bookstore";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		} 
	$sql="select username, password from customers where username='$user' and password='$userpassword'";
	
	$result = $conn->query($sql);
	$rows=$result->num_rows;
	if($rows==0){
		echo "
			<script language='javascript'>
				alert('Incorrect user name or password!');
				window.location='logIn.php';
			</script>
		";
		exit();
	}
 
	if($user == "admin" and $userpassword ="admin"){
		echo "
			<script language='javascript'>
				window.location='admin.php';
			</script>
		";
	}
 
	session_start();
	$_SESSION["user"]=$user;
	echo "
		<script language='javascript'>
			window.location='main.php';
		</script>
    ";
	exit();
	$conn->close();
 
?>
