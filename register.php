<!DOCTYPE html>
<html>
<head>
<title>Login</title>

</head>
<body>
<?php
session_start();
?>

<h1>LOGIN</h1> <br>

<h4>New User</h4>
<form action="controller.php" method="get">
	Username: <input type = "text" id = "new_username" name = "new_username" required> <br>
	Password: <input type="password" id="new_password" name="new_password" required> <br>
	<input type="submit" name="new" value="Sign Up" onclick = "newUser()"> <br> <br><br>
</form>

<div id = "divToChange"></div><br><br><br>

<h4>Returning User</h4>
<form action="controller.php" method="get">
	Username: <input type = "text" id = "return_username" name = "return_username" required> <br>
	Password: <input type="password" id="return_password" name="return_password" required> <br>
	<input type="submit" name="returning" value="Sign In" onclick = "returnUser()"> <br>
</form>

<script>
function newUser() {
	var new_username = document.getElementById("new_username").value;
	var new_password = document.getElementById("new_password").value;
	
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "controller.php?new_username=" + new_username + "&new_password=" + new_password, true);
	ajax.send();
	
	ajax.onreadystatechange = function(){
		console.log("State: " + ajax.readyState);
		if (ajax.readyState == 4 && ajax.status == 200) {
			//comment
		}
	}
	
}


</script>




</body>
</html>

