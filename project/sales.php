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
				echo "<a style='color:navy' href='editBook.php'>Edit Book</a>";
				echo "  ";
				echo "<a style='color:red'>Sales Information</a>";
			}else{	
				echo "
					<script language='javascript'>
						 window.location='main.php';
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
			
			$sql = "select sum(quantity) as total, ISBN13
				from book_order
				group by ISBN13
			";
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				
				while($row = $result->fetch_assoc()) {
					
					$ISBN13[] = $row["ISBN13"];
					$sum[] = $row["total"];
					
				}
				
				$best = $sum[0];
				$count = count($ISBN13);
				
				for ($i = 1; $i < $count; $i++){
					if ($sum[$i] > $sum[$i - 1]){
						$best = $sum[$i];
					}
				}
				
				echo "
					<fieldset>
						<legend>Best Seller</legend>
						<form name=\"BestSellerForm\" method=\"post\" action=\"sales.php\">
				";
				
				for ($i = 0; $i < $count; $i++){
					
					if ($sum[$i] == $best){
						echo "
							<p>
							<label class=\"label1\">ISBN13: $ISBN13[$i] Qty: $sum[$i]</label>
							<p/>
							<br>
						";
					}
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
		<?php
			echo "
				<fieldset>
					<legend>Sales Amount</legend>
					<form name=\"EditBookForm\" method=\"post\" action=\"sales.php\">
					<p>
					<label for=\"end\" class=\"label\">Start Date:</label>
					<input id=end name=end type=text class=\"input1\" />
					<p/>
					<br>
					<p>
					<label for=\"start\" class=\"label\">End Date:</label>
					<input id=start name=start type=text class=\"input1\" />
					<p/>
					<br>
					<p>
					<input type=submit name=submit value=\"  Calculate  \" class=\"left\" />
					</p>
					</form>
				</fieldset>
			";
			
			if (isset ( $_POST ['submit'] )){
				
				$startDate = $_POST['start'];
				$endDate = $_POST['end'];
				
				if ($startDate != null){
					$startDate .= " 00:00:00";
					$sqlStart = "time <= '$startDate'";
				}
				
				if ($endDate != null){
					$endDate .= " 00:00:00";
					$sqlEnd = "time >= '$endDate'";
				}
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "bookstore";
				$conn = new mysqli($servername, $username, $password, $dbname);
				
				$changed = FALSE;
				$sql = "select sum(total) as sales
					from orders
					where ";
				
				if ($startDate != null){
					$sql .= $sqlStart;
					$changed = TRUE;
				}
				if (!$changed && $endDate != null){
					$sql .= $sqlEnd;
					$changed = TRUE;
				} else if ($changed && $endDate != null){
					$sql .= " and " . $sqlEnd;
					$changed = TRUE;
				}
				
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
				
					$row = $result->fetch_assoc();
					$sales = $row['sales'];
					
					echo "
						<fieldset>
							<legend>Sales Stastics</legend>
							<form name=\"StacticsForm\" method=\"post\" action=\"sales.php\">
							<p>
							<label for=\"end\" class=\"label1\">Start Date: $endDate</label>
							<p/>
							<br>
							<p>
							<label for=\"start\" class=\"label1\">End Date: $startDate</label>
							<p/>
							<br>
							<p>
							<label for=\"start\" class=\"label1\">Total: $$sales</label>
							<p/>
							</form>
						</fieldset>
					";
				} else {
					
					echo "
						<script language='javascript'>
							alert('No records during this period of time!');
							window.location='sales.php';
						</script>
					";
				}
			}
		?>
	</div>
	
	

</body>

</html>