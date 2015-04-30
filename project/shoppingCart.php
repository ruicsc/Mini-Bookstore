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
				echo "<a style='color:navy' href='account.php'>My Account</a>";
				echo "  ";
				echo "<a style='color:red'>Shopping Cart</a>";
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

	<div id="header2"></div>

	<div id="gap"></div>
	
	<div>
		<table  with frame='below'>
		<tr>
			<th width=1000 align='right'>
				<form action="shoppingCart.php" method="post">
					<input type=submit name=checkout value="Proceed to Check Out" align="right">
				</form>
				
				<?php
					if (isset ( $_POST ["checkout"] )) {
						
						if ($_SESSION["orders"] == 0){
							echo "
								<script language='javascript'>
									alert('No books in your shopping cart');
									window.location='shoppingCart.php';
								</script>
							";
						} else {
							echo "
								<script language='javascript'>
									window.location='checkout.php';
								</script>
							";
						}
					}
				?> 
			</th>
		</tr>
	</div>
	
	<?php
		$user = $_SESSION["user"];
		$_SESSION["orders"] = 0;
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "bookstore";
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		$sql = "select books.ISBN13, books.title, books.price, books.frontpagePath, books.description, books.edition, shopping_cart.quantity
			from shopping_cart, books
			where shopping_cart.username='$user' and shopping_cart.ISBN13=books.ISBN13
		";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			$tempR = -1;
			$tempT = 2;
			$tempE = 1;
			
			while($row = $result->fetch_assoc()) {
				$ISBN13 = $row["ISBN13"];
				$path= $row["frontpagePath"];
				$title = $row["title"];
				$price = $row["price"];
				$description = $row["description"];
				$edition = $row["edition"];
				$quantity = $row["quantity"];
				$authors="";
				
				$sqlBookAuthor= "select authorID
								  from book_author
								  where ISBN13 = $ISBN13
				";
				$bookAuthorID = $conn->query($sqlBookAuthor);
				if ($bookAuthorID->num_rows > 0) {
						while($row = $bookAuthorID->fetch_assoc()) {
						$authorID = $row["authorID"];
							$sqlAuthor = "select firstName, lastName
												  from author
												  where authorID = $authorID
							";
							
							$authorName = $conn->query($sqlAuthor);
							while($row = $authorName->fetch_assoc()) {
							$firstName= $row["firstName"];
							$lastName= $row["lastName"];
							$authors= $authors.$lastName.", ".$firstName.".   ";
							}
							
						}
				}
				
				echo "<table  with frame='below'>
					<tr>
						<th>
							<img src='cover\\$path'' width='150' height='220'/>
						</th>
						<th width=700 align='left'>
							<span style='color:black '>$title(Edition $edition)</span>
							<br>
							<span style='color:MidnightBlue'>by $authors</span>
							<br>
							<span style='color:black '>ISBN13: $ISBN13</span>
							<br>
							<br>
							<span style='color:LightSlateGray'>$description</span>
						</th>
						<th width=150 align='right'>
							<span style='color:MidnightBlue '>$$price</span>
							<br>
							<br>
							<form action=\"shoppingCart.php\" method=\"post\">
								Quantity:   <input type=text name=$tempT value=$quantity size=3>
								<input type=submit name=$tempE value=\"Edit\">
							</form>
							<br>
							<br>
							<form action=\"shoppingCart.php\" method=\"post\">
								<input type=submit name=$tempR value=\"Remove\">
							</form>
						</th>
					</tr>";
				
				if (isset ( $_POST [$tempR] )){
				
					if($_SESSION["user"] != null){
						$user = $_SESSION["user"];

						$sql = "delete from shopping_cart
							where username = '$user' and ISBN13 = '$ISBN13' ";
							
						if ($conn->query($sql) === TRUE) {
							$_SESSION["orders"] = $_SESSION["oders"] - 1;
							echo "
								<script language='javascript'>
									 window.location='shoppingCart.php';
								</script>
							";
						}
						else {
							echo "
								<script language='javascript'>
									alert('Error!!');
									 window.location='shoppingCart.php';
								</script>
							";
						}
							
					}
				}
				
				if (isset ( $_POST [$tempE] )){
				
					if($_SESSION["user"] != null){
						$user = $_SESSION["user"];
						$newQuantity = $_POST[$tempT];

						$sql = "update shopping_cart set quantity = $newQuantity
							where username = '$user' and ISBN13 = '$ISBN13' ";
							
						if ($conn->query($sql) === TRUE) {
							echo "
								<script language='javascript'>
									 window.location='shoppingCart.php';
								</script>
							";
						}
						else {
							echo "
								<script language='javascript'>
									alert('Error!!');
									 window.location='shoppingCart.php';
								</script>
							";
						}
							
					}
				}
				
				$tempT = $tempT + 2;
				$tempE = $tempE + 2;
				$tempR = $tempR - 1;
				$_SESSION["orders"] = $_SESSION["orders"] + 1;
			}
		} else {
			echo "Your shopping cart is empty.";
		}

		$conn->close();

	?>

</body>

</html>