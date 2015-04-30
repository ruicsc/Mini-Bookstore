<?php
session_start();
//$_SESSION["user"]= "u";
//$_SESSION["user"]= null;
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

if(!isset($_SESSION['user']) || $_SESSION["user"] == null){
	echo "<a style='color:navy' href='logIn.php'>Login</a>";
	echo "  ";
	echo "<a style='color:navy' href='register.php'>Register</a>";
	session_unset();
	
}else{	
	echo "<a style='color:red'>Hi, </a>"."<a style='color:red'>".$_SESSION["user"]."</a>"."<a style='color:red'>!    </a>";
	echo "<a style='color:navy' href='account.php'>My account</a>";
	echo "  ";
	echo "<a style='color:navy' href='shoppingCart.php'>Shoping cart</a>";
	echo "  ";
	echo "<a style='color:navy' href='wishlist.php'> Wish list</a>";
}

echo "  ";
echo "<a style='color:navy' href='search.php'>Advance Search</a>";

?> 

</div>

<a href="main.php"><img src="671BOOKS.jpg"; width="380" height="80"> </a>

<div id="header2">

</div>


<div id="nav">
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
<input type=submit name=all class="styled-button-1" value="Show all" /> <br>
<input type=submit name=business class="styled-button-2" value="Business" /> <br>
<input type=submit name=computers class="styled-button-1" value="Computers" /> <br>
<input type=submit name=education class="styled-button-2" value="Education" /> <br>
<input type="submit" name=history class="styled-button-1" value="History" /> <br>
</form>
<style type="text/css">
.styled-button-1 {
	cursor:pointer;
	color:white;
	background-color:DeepSkyBlue   ;
	border:none;
	font-family:'Helvetica Neue',Arial,sans-serif;
	font-size:16px;
	font-weight:700;
	height:32px;
	width: 150px;
	padding:4px 16px;
}
.styled-button-2 {
	cursor:pointer;
	color:white;
	background-color:CornflowerBlue    ;
	border:none;
	font-family:'Helvetica Neue',Arial,sans-serif;
	font-size:16px;
	font-weight:700;
	height:32px;
	width: 150px;
	padding:4px 16px;
}
 </style>
</div>

<?php
$category = "All";

if (isset ( $_POST ["business"] )) {
	$category = "business";	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bookstore";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "select ISBN13, title, price, frontpagePath, description,edition
			from books
			where categoryID='C1'
	";
$result = $conn->query($sql);

include "showBooks.php";

$conn->close();
	
	
}

if (isset ( $_POST ["computers"] )) {
	$category = "computers";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bookstore";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "select ISBN13, title, price, frontpagePath, description,edition
			from books
			where categoryID='C2'
	";
$result = $conn->query($sql);

include "showBooks.php";

$conn->close();
}

if (isset ( $_POST ["education"] )) {
	$category = "education";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bookstore";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "select ISBN13, title, price, frontpagePath, description,edition
			from books
			where categoryID='C3'
	";
$result = $conn->query($sql);

include "showBooks.php";

$conn->close();
}

if (isset ( $_POST ["history"] )) {
	$category = "history";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bookstore";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "select ISBN13, title, price, frontpagePath, description,edition
			from books
			where categoryID='C4'
	";
$result = $conn->query($sql);

include "showBooks.php";

$conn->close();
}


if (isset ( $_POST ["All"] )) {
	$category = "All";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bookstore";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "select ISBN13, title, price, frontpagePath, description,edition
			from books
	";
$result = $conn->query($sql);

include "showBooks.php";

$conn->close();
}


if ($category == "All"){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bookstore";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "select ISBN13, title, price, frontpagePath, description,edition
			from books
	";
$result = $conn->query($sql);

include "showBooks.php";

$conn->close();
}

?>

</body>
</html>