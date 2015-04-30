<?php
	session_start();
?>

<!DOCTYPE HTML>
<html> 

<head>
<style>
	#header1 {
		background-color:white;
		color:black;
		text-align:right;
		padding:2px;
	}

	#header2 {
		background-color:SteelBlue  ;
		color:black;
		text-align:right;
		padding:13px;
	}

	#nav {
		line-height:30px;
		background-color:whitesmoke;
		height:2500px;
		width:150px;
		float:left;
		padding:5px;	      
	}
	
	#bookcover{
		height:440px;
		width:300px;
		float:left;
	}
		
	label{
		display:block;
		width:120px;
		float:left;
		clear:left;
	}
	
	.label1{
		display:block;
		width:500px;
		float:left;
		clear:left;
	}
	
	#gap {   
		height:30px;	      
	}
	
	.input1{
		width:400px;
		float:left;
	}

</style>
</head>


<body>

	<div id="header1">
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
			<input type=submit name=logout value="Log Out">
		</form>

		<?php
			if (isset ( $_POST ["logout"] )) {
				session_unset();
			}

			if(isset($_SESSION['user'])){
				echo "<a style='color:red'>Hi, </a>"."<a style='color:red'>".$_SESSION["user"]."</a>"."<a style='color:red'>!    </a>";
				echo "  ";
				echo "<a style='color:red'>Pending Order</a>";
				echo "  ";
				echo "<a style='color:navy' href='editBook.php'>Edit Book</a>";
				echo "  ";
				echo "<a style='color:navy' href='sales.php'>Sales Information</a>";
			}else{	
				echo "
					<script language='javascript'>
						 window.location='main.php';
					</script>
				";
			}
		?> 

	</div>

	<a href="admin.php"><img src="671BOOKS.jpg"; width="380" height="80"> </a>

	<div id="header2"></div>
	
	<div id="gap"> </div>
	
	<div>
		<?php
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "bookstore";
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			$sql = "select books.title, books.price, book_order.quantity, orders.orderNo, orders.status
				from orders
					join book_order on orders.orderNo=book_order.orderNo
					join customer_order on customer_order.orderNo=orders.orderNo
					join books on book_order.ISBN13=books.ISBN13
				where orders.status='Paid'
			";
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				
				$temp = 1;
				
				while($row = $result->fetch_assoc()) {
					
					$orderNo[] = $row["orderNo"];
					$status[] = $row["status"];
					$title[] = $row["title"];
					$price[] = $row["price"];
					$quantity[] = $row["quantity"];
					
				}
				
				$count = count($title);
				$total = 0.0;
				$order1 = 0;
				$order2 = $orderNo[0];
				$orderEnd = 0;
				
				for ($i = 0; $i < $count; $i++){
					
					if($order2 != $orderNo[$i]){
						echo "
							<br><br>Status: $status[$i]<br>
							<label class=\"label1\">Total: $$total</label><br><br>
							<input type=submit name=$temp value=\"Process Order\">
							</form>
							</fieldset>
						";
						$order2 = $orderNo[$i];
						
						if (isset ( $_POST [$temp] )){
							
							$success = TRUE;

							for ($j = 0; $j < $i - $orderEnd; $j++){
								
								$tempTitle = $title[$orderEnd + $j];
								$sqlcheck1 = "select availableNum
									from books
									where title='$tempTitle'
								";
								$result1 = $conn->query($sqlcheck1);
								
								while ($row1 = $result1->fetch_assoc()) {
									$available[$j] = $row1["availableNum"];
								}
								
								if ($available[$j] < $quantity[$orderEnd + $j]) {
									$success = FALSE;
									echo "
										<script language='javascript'>
											alert('Not enough books!');
											window.location='admin.php';
										</script>
									";
								}
							}
							
							if ($success){
								for ($j = 0; $j < $i - $orderEnd; $j++){
									$available[$j] -= $quantity[$orderEnd + $j];
								}
								
								for ($j = 0; $j < $i - $orderEnd; $j++){
								
									$tempTitle = $title[$orderEnd + $j];
									$sqlUpdate1 = "update books set availableNum='$available[$j]'
										where title='$tempTitle'
									";
									$conn->query($sqlUpdate1);
								}
								
								$sqlStatus1 = "update orders set status='Processed'
									where orderNo='$orderNo[$orderEnd]'
								";
								$conn->query($sqlStatus1);
							}
							
							unset($available);
							
						}
						$orderEnd = $i;
						$temp += 1;						
					}
					
					if($order1 != $orderNo[$i]){
						$order1 = $orderNo[$i];
						$total = 0.0;
						echo "
							<fieldset>
								<legend>Order $orderNo[$i] Summary</legend>
								<form name=\"ProcessForm\" method=\"post\" action=\"admin.php\">
						";
					}
					
					echo "
						<p>
						<label class=\"label1\">$title[$i]<br>$$price[$i] Qty: $quantity[$i]</label>
						<p/>
						<br>
						<br>
					";
					
					$total = $total + (float) $price[$i] * $quantity[$i];
					
					if($count - $i == 1){
						echo "
							<br><br>Status: $status[$i]<br>
							<label class=\"label1\">Total: $$total</label><br><br>
							<input type=submit name=$temp value=\"Process Order\">
							</form>
							</fieldset>
						";
						
						if (isset ( $_POST [$temp] )){
							
							$success = TRUE;

							for ($j = 0; $j < $count - $orderEnd; $j++){
								
								$tempTitle = $title[$orderEnd + $j];
								$sqlcheck2 = "select availableNum
									from books
									where title = '$tempTitle'
								";
								$result2 = $conn->query($sqlcheck2);
								
								while ($row2 = $result2->fetch_assoc()) {
									$available[$j] = $row2["availableNum"];
								}
								
								if ($available[$j] < $quantity[$orderEnd + $j]) {
									$success = FALSE;
									echo "
										<script language='javascript'>
											alert('Not enough books!');
											window.location='admin.php';
										</script>
									";
								}
							}
							
							if ($success){
								for ($j = 0; $j < $count - $orderEnd; $j++){
									$available[$j] -= $quantity[$orderEnd + $j];
								}
								
								for ($j = 0; $j < $count - $orderEnd; $j++){
								
									$tempTitle = $title[$orderEnd + $j];
									$sqlUpdate2 = "update books set availableNum='$available[$j]'
										where title='$tempTitle'
									";
									$conn->query($sqlUpdate2);
								}
								
								$sqlStatus2 = "update orders set status='Processed'
									where orderNo='$orderNo[$orderEnd]'
								";
								$conn->query($sqlStatus2);
							}
							
							unset($available);
						}
					}
				}
				
			} else {
				echo "No pending orders found!";
			}
			$conn->close();
		?>
	</div>


</body>

</html>