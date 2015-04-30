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

<script language=JavaScript>


	function InputCheck(CheckoutForm)
	{
	  if (CheckoutForm.name.value == "")
	  {
		alert("Please input your name!");
		CheckoutForm.name.focus();
		return (false);
	  }
	  if (CheckoutForm.address.value == "")
	  {
		alert("Please input your address!");
		CheckoutForm.address.focus();
		return (false);
	  }
	  if (CheckoutForm.cardNo.value == "")
	  {
		alert("Please input your credit card number!");
		CheckoutForm.cardNo.focus();
		return (false);
	  }
	}

</script>
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
				echo "<a style='color:red'>Check Out</a>";
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
			
			$sql = "select books.title, books.price, shopping_cart.quantity
				from shopping_cart, books
				where shopping_cart.username='$user' and shopping_cart.ISBN13=books.ISBN13
			";
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				
				while($row = $result->fetch_assoc()) {
					
					$title[] = $row["title"];
					$price[] = $row["price"];
					$quantity[] = $row["quantity"];
					
				}
				
				echo "
					<fieldset>
						<legend>Order Summary</legend>
						<form name=\"CheckoutForm\" method=\"post\" action=\"checkout.php\">
					";
				
				$count = count($title);
				$total = 0.0;
				for ($i = 0; $i < $count; $i++){
					echo "
						<p>
						<label class=\"label1\">$title[$i]<br>$$price[$i] Qty: $quantity[$i]</label>
						<p/>
						<br>
						<br>
					";
					$total = $total + (float) $price[$i] * $quantity[$i];
				}
				
				echo "
					<br>
					<label class=\"label1\">Total: $$total</label>
					</form>
					</fieldset>
				";
				
				$_SESSION["total"] = $total;

			} else {
				echo "
					<script language='javascript'>
						alert('Error!');
						window.location='shoppingCart.php';
					</script>
				";
			}
			$conn->close();
		?>
	</div>
	
	<div>
		<fieldset>
		<legend>Check Out</legend>
		<form name="CheckoutForm" method="post" action="checkoutSubmit.php" onSubmit="return InputCheck(this)">
		<p>
		<label for="name" class="label">Full Name:</label>
		<input id="name" name="name" type="text" class="input1" />
		<p/>
		<br>
		<p>
		<label for="address" class="label">Address:</label>
		<input id="address" name="address" type="text" class="input1" />
		</p>
		<br>
		<p>
		<label for="cardNo" class="label">Credit Card No.:</label>
		<input id="cardNo" name="cardNo" type="text" class="input1" />
		</p>
		<br>
		<p>
		<input type="submit" name="submit" value="  Check Out  " class="left" />
		</p>
		</form>
		</fieldset>
	</div>

</body>

</html>