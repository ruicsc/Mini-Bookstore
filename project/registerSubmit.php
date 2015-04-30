<?php

	$user = $_POST["username"];
	$userpassword = $_POST["password"];
	$userpasswordagain = $_POST["passwordagain"];
	
	if($userpassword !=$userpasswordagain ){
		echo "
			<script language='javascript'>
				alert('The two passwords you input do not match！');
				window.location='register.php';
			</script>
		";
		exit();
	}
	
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bookstore";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		} 
	$sql="select username from customers where username='$user'";
	
	$result = $conn->query($sql);
	$rows=$result->num_rows;
	if($rows > 0){
		echo "
			<script language='javascript'>
				alert('The user name has already been used!');
				window.location='register.php';
			</script>
		";
	exit();
	}
 
	echo $user.$userpassword;
	$sql2 = "INSERT INTO customers (username, password)
			VALUES ('$user', '$userpassword')";

			

	if ($conn->query($sql2) === TRUE) {
		echo "
			<script language='javascript'>
				alert('Register successfully!');
				window.location='main.php';
			</script>
		";
		exit();
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}			
			
	$conn->close();
  
 
 
?>
