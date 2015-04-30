
<!DOCTYPE html >
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
	<title>Log in</title>
	<style type="text/css">
		html{font-size:12px;}
		fieldset{width:520px; margin: 0 auto;}
		legend{font-weight:bold; font-size:14px;}
		label{float:left; width:70px; margin-left:10px;}
		.left{margin-left:80px;}
		.input{width:150px;}
		span{color: #666666;}
	</style>
	<script language=JavaScript>


		function InputCheck(LoginForm)
		{
		  if (LoginForm.username.value == "")
		  {
			alert("Please input your user name!");
			LoginForm.username.focus();
			return (false);
		  }
		  if (LoginForm.password.value == "")
		  {
			alert("Please input your password!");
			LoginForm.password.focus();
			return (false);
		  }
		}


	</script>
	
</head>

<body>
	<div>
		<fieldset>
		<legend>Log in</legend>
		<form name="LoginForm" method="post" action="logInSubmit.php" onSubmit="return InputCheck(this)">
		<p>
		<label for="username" class="label">User name:</label>
		<input id="username" name="username" type="text" class="input" />
		</p>
		<p>
		<label for="password" class="label">Password:</label>
		<input id="password" name="password" type="password" class="input" />
		</p>
		<p>
		<input type="submit" name="submit" value="  Log in  " class="left" />
		</p>
		</form>
		</fieldset>
	</div>



</body>
</html>