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
			$ISBN13 = $_POST["ISBN13"];
			$edition = $_POST["edition"];
			$categoryID = $_POST["categoryID"];
			$availableNum = $_POST["availableNum"];
			$price = $_POST["price"];
			$description = $_POST["description"];
			$frontpagePath = $_POST["frontpagePath"];
			
			$sqlTitle = "title='$title'";
			$sqlPubliser = "publisher='$publisher'";
			$sqlYear = "year='$year'";
			$sqlPrice = "price='$price'";
			$sqlISBN13 = "price='$ISBN13'";
			$sqlEdition = "edition='$edition'";
			$sqlCategoryID = "categoryID='$categoryID'";
			$sqlAvailableNum = "availableNum='$availableNum'";
			$sqlDescription = "description='$description'";
			$sqlFrontpagePath = "frontpagePath='$frontpagePath'";
			
			if ($ISBN13 == null) {
				echo "
					<script language='javascript'>
						alert('Please enter ISBN13!');
						window.location='editBook.php';
					</script>
				";
			} else {
				
				$sqlcheck = "select ISBN13
					from books
					where ISBN13='$ISBN13'
				";
				
				$result1 = $conn->query($sqlcheck);
				
				if ($result1->num_rows > 0){
					
					$changed = FALSE;
					
					$sql = "update books set ";
					
					if ($title != null){
						$sql .= $sqlTitle;
						$changed = TRUE;
					}
					if (!$changed && $publisher != null){
						$sql .= $sqlPubliser;
						$changed = TRUE;
					} else if ($changed && $publisher != null){
						$sql .= ", " . $sqlPubliser;
						$changed = TRUE;
					}
					if (!$changed && $year != null){
						$sql .= $sqlYear;
						$changed = TRUE;
					} else if ($changed && $year != null){
						$sql .= ", " . $sqlYear;
						$changed = TRUE;
					}
					if (!$changed && $price != null){
						$sql .= $sqlPrice;
						$changed = TRUE;
					} else if ($changed= null && $price != null){
						$sql .= ", " . $sqlPrice;
						$changed = TRUE;
					}
					if (!$changed && $edition != null){
						$sql .= $sqlEdition;
						$changed = TRUE;
					} else if ($changed && $edition != null){
						$sql .= ", " . $sqlEdition;
						$changed = TRUE;
					}
					if (!$changed && $availableNum != null){
						$sql .= $sqlAvailableNum;
						$changed = TRUE;
					} else if ($changed && $availableNum != null){
						$sql .= ", " . $sqlAvailableNum;
						$changed = TRUE;
					}
					if (!$changed && $categoryID != null){
						$sql .= $sqlCategoryID;
						$changed = TRUE;
					} else if ($changed && $categoryID != null){
						$sql .= ", " . $sqlCategoryID;
						$changed = TRUE;
					}
					if (!$changed && $description != null){
						$sql .= $sqlDescription;
						$changed = TRUE;
					} else if ($changed= null && $description != null){
						$sql .= ", " . $sqlDescription;
						$changed = TRUE;
					}
					if (!$changed && $frontpagePath != null){
						$sql .= $sqlFrontpagePath;
						$changed = TRUE;
					} else if ($changed && $frontpagePath != null){
						$sql .= ", " . $sqlFrontpagePath;
						$changed = TRUE;
					}
					
					$sql .= " where ISBN13='$ISBN13'";
					
					if ($conn->query($sql)){
						echo "
							<script language='javascript'>
								alert('Book updated successfully!');
								window.location='editBook.php';
							</script>
						";
						$conn->close();
					} else {
						echo "
							<script language='javascript'>
								alert('Book not updated!');
								window.location='editBook.php';
							</script>
						";
						$conn->close();
					}
					
				} else {
					
					if ($title != null && $publisher != null && $year != null && $edition != null
						&& $categoryID != null && $availableNum != null && $price != null && $description != null
						&& $frontpagePath != null){
							
						$sqlAdd = "insert into books (title, publisher, year, ISBN13, edition, categoryID, availableNum,
							 price, description, frontpagePath) values ('$title', '$publisher', '$year', '$ISBN13',
							 '$edition', '$categoryID', '$availableNum', '$price', '$description', '$frontpagePath')";
					
						if ($conn->query($sqlAdd)){
							echo "
								<script language='javascript'>
									alert('Book added successfully!');
									window.location='editBook.php';
								</script>
							";
							$conn->close();
						} else {
							echo "
								<script language='javascript'>
									alert('Book not added!');
									window.location='editBook.php';
								</script>
							";
							$conn->close();
						}
					}
				}
				
			}
		?>
		
</body>

</html>