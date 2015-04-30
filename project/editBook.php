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
				echo "<a style='color:navy' href='admin.php'>Pending Order</a>";
				echo "  ";
				echo "<a style='color:red'>Edit Book</a>";
				echo "  ";
				echo "<a style='color:navy' href='sales.php'>Sales Information</a>";
			}else{	
				echo "
					<script language='javascript'>
						 window.location='admin.php';
					</script>
				";
			}
		?> 

	</div>

	<a href="main.php"><img src="671BOOKS.jpg"; width="380" height="80"> </a>

	<div id="header2"></div>

	<div id="gap"> </div>
	
	<div>
		<?php
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "bookstore";
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			$sql = "select title, ISBN13, availableNum
				from books
			";
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				
				while($row = $result->fetch_assoc()) {
					
					$title[] = $row["title"];
					$ISBN13[] = $row["ISBN13"];
					$availableNum[] = $row["availableNum"];
					
				}
				
				$count = count($ISBN13);
				
				echo "
					<fieldset>
						<legend>Books Summary</legend>
						<form name=\"BookForm\" method=\"post\" action=\"editBook.php\">
				";
				
				for ($i = 0; $i < $count; $i++){
					echo "
						<p>
						<label class=\"label1\">ISBN13: $ISBN13[$i]<br>Title: $title[$i] Qty: $availableNum[$i]</label>
						<p/>
						<br>
						<br>
					";
				}
				
				echo "
					</form>
					</fieldset>
				";
			}
			$conn->close();
		?>
	</div>
	
	<div>
		<fieldset>
		<legend>Edit Book</legend>
		<form name="EditBookForm" method="post" action="editSubmit.php">
		<p>
		<label for="name" class="label">Book Name:</label>
		<input id="name" name="name" type="text" class="input1" />
		<p/>
		<br>
		<p>
		<label for="ISBN13" class="label">ISBN13:</label>
		<input id="ISBN13" name="ISBN13" type="text" class="input1" />
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
		<label for="edition" class="label">Edition:</label>
		<input id="edition" name="edition" type="text" class="input1" />
		</p>
		<br>
		<p>
		<label for="categoryID" class="label">Category ID:</label>
		<input id="categoryID" name="categoryID" type="text" class="input1" />
		</p>
		<br>
		<p>
		<label for="availableNum" class="label">Available No.:</label>
		<input id="availableNum" name="availableNum" type="text" class="input1" />
		</p>
		<br>
		<p>
		<label for="price" class="label">Price:</label>
		<input id="price" name="price" type="text" class="input1" />
		</p>
		<br>
		<p>
		<label for="frontpagePath" class="label">Front Page Path:</label>
		<input id="frontpagePath" name="frontpagePath" type="text" class="input1" />
		</p>
		<br>
		<p>
		<label for="description" class="label">Description:</label>
		<input id="description" name="description" type="text" class="input1" />
		</p>
		<br>
		<p>
		<input type="submit" name="submit" value="  Edit Book  " class="left" />
		</p>
		</form>
		</fieldset>
	</div>

</body>

</html>