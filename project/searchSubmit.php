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
		
		.input1{
			width:400px;
			float:left;
		}
		
		.input2{
			width:150px;
			float:left;
		}
		
		.input3{
			width:150px;
			float:left;
		}

	</style>
</head>


<body>

	<div id="header1">
		<form action="main.php" method="post">
			<input type=submit name=logout value="Log Out">
		</form>

		<?php
			if (isset ( $_POST ["logout"] )) {
				session_unset();
				echo "
					<script language='javascript'>
						window.location='main.php';
					</script>
				";
			}


			if(isset($_SESSION["user"])){
				echo "<a style='color:red'>Hi, </a>"."<a style='color:red'>".$_SESSION["user"]."</a>"."<a style='color:red'>!    </a>";
				echo "  ";
				echo "<a style='color:navy' href='account.php'>My Account</a>";
				echo "  ";
				echo "<a style='color:navy' href='shoppingCart.php'>Shopping Cart</a>";
				echo "  ";
				echo "<a style='color:navy' href='wishlist.php'> Wish List</a>";
			}else{
				echo "<a style='color:navy' href='logIn.php'>Login</a>";
				echo "  ";
				echo "<a style='color:navy' href='register.php'>Register</a>";
			}
			echo "  ";
			echo "<a style='color:red'>Advance Search</a>";
		?> 
	</div>
	
	<a href="main.php"><img src="671BOOKS.jpg"; width="380" height="80"></a>

	<div id="header2"> </div>

	<div id="gap"> </div>		
	
	<?php
						
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "bookstore";
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			$title = $_POST["name"];
			$publisher = $_POST["publisher"];
			$year = $_POST["year"];
			$priceLow = (float) $_POST["price1"];
			$priceHigh = (float) $_POST["price2"];
			
			$sqlTitle = "title='$title'";
			
			$sqlPubliser = "publisher='$publisher'";
			
			$sqlYear = "year='$year'";
			
			$sqlPriceLow = "price >= '$priceLow'";
			
			$sqlPriceHigh = "price <= '$priceHigh'";
			
			if ($title == null && $publisher == null && $year == null && $priceLow == null && $priceHigh == null) {
				echo "
					<script language='javascript'>
						alert('Please enter at least one condition!');
						window.location='search.php';
					</script>
				";
			} else {
				
				$sql = "select ISBN13, title, price, frontpagePath, description,edition
					from books
					where ";
					
				$changed = FALSE;
				
				if ($title != null){
					$sql .= $sqlTitle;
					$changed = TRUE;
				}
				if (!$changed && $publisher != null){
					$sql .= $sqlPubliser;
					$changed = TRUE;
				} else if ($changed && $publisher != null){
					$sql .= " and " . $sqlPubliser;
					$changed = TRUE;
				}
				if (!$changed && $year != null){
					$sql .= $sqlYear;
					$changed = TRUE;
				} else if ($changed && $year != null){
					$sql .= " and " . $sqlYear;
					$changed = TRUE;
				}
				if (!$changed && $priceLow != null){
					$sql .= $sqlPriceLow;
					$changed = TRUE;
				} else if ($changed= null && $priceLow != null){
					$sql .= " and " . $sqlPriceLow;
					$changed = TRUE;
				}
				if (!$changed && $priceHigh != null){
					$sql .= $sqlPriceHigh;
					$changed = TRUE;
				} else if ($changed && $priceHigh != null){
					$sql .= " and " . $sqlPriceHigh;
					$changed = TRUE;
				}
				
				$result = $conn->query($sql);
				if ($result == null || $result->num_rows == 0){
					echo "
					<script language='javascript'>
						alert('No book found!');
						window.location='search.php';
					</script>
				";
				} else {
					include "showBooks.php";
					$conn->close();
				}
			}
		
		?>
		
</body>

</html>