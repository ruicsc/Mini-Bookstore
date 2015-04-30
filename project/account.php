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
			padding:15px;
		}

		#gap {   
			height:30px;	      
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
				echo "<a style='color:red'>My Account</a>";
				echo "  ";
				echo "<a style='color:navy' href='shoppingCart.php'>Shopping Cart</a>";
				echo "  ";
				echo "<a style='color:navy' href='wishlist.php'> Wish List</a>";
				echo "  ";
				echo "<a style='color:navy' href='search.php'>Advance Search</a>";
			}else{
				echo "
				<script language='javascript'>
					 window.location='main.php';
				</script>
				";
			}

		?> 
	</div>
	
	<a href="main.php"><img src="671BOOKS.jpg"; width="380" height="80"></a>

	<div id="header2"> </div>

	<div id="gap"> </div>

	<div>
		<?php
			
			$user = $_SESSION["user"];
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
				where customer_order.username='$user'
			";
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				
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
				for ($i = 0; $i < $count; $i++){
					
					if($order2 != $orderNo[$i]){
						echo "
							<br><br>Status: $status[$i]<br>
							<label class=\"label1\">Total: $$total</label>
							</form>
							</fieldset>
						";
						$order2 = $orderNo[$i];
					}
					
					if($order1 != $orderNo[$i]){
						$order1 = $orderNo[$i];
						$total = 0.0;
						echo "
							<fieldset>
								<legend>Order $orderNo[$i] Summary</legend>
								<form name=\"AccountForm\" method=\"post\" action=\"checkout.php\">
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
							<label class=\"label1\">Total: $$total</label>
							</form>
							</fieldset>
						";
					}
				}
				
			} else {
				echo "
					<script language='javascript'>
						alert('No record!');
						window.location='main.php';
					</script>
				";
			}
			$conn->close();
		?>
	</div>

</body>

</html>