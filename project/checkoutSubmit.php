<?php
	
	session_start();
	
	$user = $_SESSION['user'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$creditNo = $_POST['cardNo'];
	$error = FALSE;
	$date = date('Y-m-d H:i:s');
	$total = $_SESSION["total"];
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bookstore";
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql1 = "select max(orderNo) as max from orders";
	
	$result1 = $conn->query($sql1);	
	$rows1 = $result1->fetch_assoc();
	
	$max = $rows1['max'];
	
	if($max >= 1){
		$orderNo = $max + 1;
	} else {
		$orderNo = 1;
	}
	
	$delete1 = "delete from orders
		where orderNo='$orderNo'
	";
	$delete2 = "delete from book_order
		where orderNo='$orderNo'
	";
	$delete3 = "delete from customer_order
		where orderNo='$orderNo'
	";
	
	$sql2 = "INSERT INTO orders (orderNo, time, status, creditNo, address, total)
		VALUES ('$orderNo', '$date', 'Paid', '$creditNo', '$address', '$total')";
		
	if ($conn->query($sql2) === FALSE) {
		
		echo "
			<script language='javascript'>
				alert('Error! 1');
				window.location='checkout.php';
			</script>
		";
		
		$conn->query($delete1);
		$conn->query($delete2);
		$conn->query($delete3);
		
		$error = TRUE;
	}
	
	$sql3 = "select shopping_cart.ISBN13, shopping_cart.quantity
		from shopping_cart
		where shopping_cart.username='$user'
	";
			
	$result3 = $conn->query($sql3);
			
	if ($result3->num_rows > 0) {
				
		while($rows3 = $result3->fetch_assoc()) {
					
			$ISBN13[] = $rows3["ISBN13"];
			$quantity[] = $rows3["quantity"];
					
		}
	} else {
		echo "
			<script language='javascript'>
				alert('Error! 2');
				window.location='checkout.php';
			</script>
		";
		
		$error = TRUE;
	}
		
	$count = count($quantity);
	for ($i = 0; $i < $count; $i++){
		$sqlOrder[$i] = "INSERT INTO book_order (orderNo, ISBN13, quantity)
			VALUES ('$orderNo', '$ISBN13[$i]', '$quantity[$i]')";
		
		if ($conn->query($sqlOrder[$i]) === FALSE) {
		
			echo "
				<script language='javascript'>
					alert('Error! 3');
					window.location='checkout.php';
				</script>
			";
			
			$conn->query($delete1);
			$conn->query($delete2);
			$conn->query($delete3);
			
			$error = TRUE;
		}
	}
		
	$sql4 = "INSERT INTO customer_order (username, orderNo)
		VALUES ('$user', '$orderNo')";
		
	if ($conn->query($sql4) === FALSE) {
		
		echo "
			<script language='javascript'>
				alert('Error! 4');
				window.location='checkout.php';
			</script>
		";
		
		$conn->query($delete1);
		$conn->query($delete2);
		$conn->query($delete3);
		
		$error = TRUE;
	}
	
	if (!$error) {
		$clear = "DELETE FROM shopping_cart
			WHERE username = '$user'";
			
		$conn->query($clear);
		
		echo "
			<script language='javascript'>
				alert('Order was placed successfully!');
				window.location='main.php';
			</script>
		";
	}

	exit();
	$conn->close();
 
?>
