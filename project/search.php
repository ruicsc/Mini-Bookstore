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

	<div>
		<fieldset>
		<legend>Search</legend>
		<form name="SearchForm" method="post" action="searchSubmit.php">
		<p>
		<label for="name" class="label">Book Name:</label>
		<input id="name" name="name" type="text" class="input1" />
		<p/>
		<br>
		<p>
		<label for="publisher" class="label">Publisher:</label>
		<input id="publisher" name="publisher" type="text" class="input1" />
		</p>
		<br>
		<p>
		<label for="year" class="label">Year:</label>
		<input id="year" name="year" type="text" class="input1" />
		</p>
		<br>
		<p>
		<label for="price" class="label">Price:</label><br>
		<label for="from" class="label">from:</label>
		<input id="price1" name="price1" type="text" class="input2" /><br>
		<label for="to" class="label">to:</label>
		<input id="price2" name="price2" type="text" class="input2" />
		</p>
		<br>
		<p>
		<input type="submit" name="submit" value="  Search  " class="left" />
		</p>
		</form>
		</fieldset>
	</div>

</body>

</html>