<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>

</head>
<body>


<h1>LOGIN</h1> <br>

<h4>New User</h4>
<form action="controller.php" method="get">
	Username: <input type = "text" id = "new_username" name = "new_username" required> <br>
	Password: <input type="password" id="new_password" name="new_password" required> <br>
	<input type="submit" name="new" value="Sign Up"> <br> <br><br>
</form>

<br><br><br>

<h4>Returning User</h4>
<form action="controller.php" method="get">
	Username: <input type = "text" id = "return_username" name = "return_username" required> <br>
	Password: <input type="password" id="return_password" name="return_password" required> <br>
	<input type="submit" name="return" value="Sign In"> <br>
</form>

<script>

</script>



</body>
</html>

