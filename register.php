<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
<h1>LOGIN</h1> <br>

<h4>New User</h4>
<form action="controller.php" method="get">
	Username: <input type = "text" id = "username" name = "username" required> <br>
	Password: <input type="password" id="password" name="password" required> <br>
	<input type="submit" name="new" value="Sign Up"> <br> <br><br>
</form>


<h4>Returning User</h4>
<form action="controller.php" method="get">
	Username: <input type = "text" id = "username" name = "username" required> <br>
	Password: <input type="password" id="password" name="password" required> <br>
	<input type="submit" name="returning" value="Sign In"> <br>
</form>





</body>
</html>

