<?php
	if ($result->num_rows > 0) {
		// output data of each row
		$tempC = 1;
		$tempW = -1;
		while($row = $result->fetch_assoc()) {
			$ISBN13 = $row["ISBN13"];
			$path= $row["frontpagePath"];
			$title = $row["title"];
			$price = $row["price"];
			$description = $row["description"];
			$edition = $row["edition"];
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
					
			echo "<table  with frame='below'><tr>";
					echo "<th><img src='cover\\$path'' width='150' height='220'/></th>";
					echo "<th width=700 align='left'><span style='color:black '>$title(Edition $edition)</span></a> <br><span style='color:MidnightBlue'>by $authors</span><br><span style='color:black '>ISBN13: $ISBN13</span><br><br><span style='color:LightSlateGray'>$description</span></th>";
					echo "<th width=150 align='right'><span style='color:MidnightBlue '>$$price</span><br><br><form action=\"main.php\" method=\"post\"><input type=submit name=$tempC value=\"Add to cart\"><br><br><input type=submit name=$tempW value=\"Add to wishlist\"></form></th></tr>";
					
					
			
		if (isset ( $_POST [$tempC] )){
			
			if($_SESSION["user"] != null){
				$user = $_SESSION["user"];

				$sqlcheck = "select username,  ISBN13
							from shopping_cart
							where username = '$user' and ISBN13= '$ISBN13'
				";
				$result = $conn->query($sqlcheck);
				if ($result->num_rows > 0)  {
					echo "
						<script language='javascript'>
							alert('The item has already been in your shopping cart!');
							window.location='main.php';
						</script>
					";
				}else {	
					$sql = "INSERT INTO shopping_cart (username, ISBN13, quantity)
						VALUES ('$user', '$ISBN13', '1')";
					
				if ($conn->query($sql) === TRUE) {
					echo "
						<script language='javascript'>
							alert('One item is added to shopping cart!');
							window.location='main.php';
						</script>
					";
				}
				else {
					echo "
						<script language='javascript'>
							alert('Error!');
							window.location='main.php';
						</script>
					";
				}
				
			}
			
			}else{
				echo "
					<script language='javascript'>
						alert('Log in first please!');
						window.location='main.php';
					</script>
				";
			}
		}

		if (isset ( $_POST [$tempW] )){
			if($_SESSION["user"] != null){
				$user = $_SESSION["user"];

				$sqlcheck = "select username,  ISBN13
							from wishlist
							where username = '$user' and ISBN13= '$ISBN13'
				";
				$result = $conn->query($sqlcheck);
				if ($result->num_rows > 0)  {
					echo "
						<script language='javascript'>
							alert('The item has already been in your Wish List!');
							window.location='main.php';
						</script>
					";
				}else {	
					$sql = "INSERT INTO wishlist (username, ISBN13)
					VALUES ('$user', '$ISBN13')";
					
				if ($conn->query($sql) === TRUE) {
					echo "
						<script language='javascript'>
							alert('One item is added to Wish List!');
							window.location='main.php';
						</script>
					";
				}
				else {
					echo "
						<script language='javascript'>
							alert('Error!');
							window.location='main.php';
						</script>
					";
				}
				
			}
			
			}else{
				echo "
					<script language='javascript'>
						alert('Log in first please!');
						window.location='main.php';
					</script>
				";
			}
			
		}



		$tempC = $tempC  + 1;
		$tempW = $tempW  - 1;
		}
	} else {
		echo "No book found.";
	}



?>