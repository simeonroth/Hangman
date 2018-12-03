<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<?php 
session_start();
?>
<link rel="stylesheet" type="text/css" href="styles2.css" />
</head>
<body>

 <div class = "col2">
<h1>Login</h1> <br>
<form onsubmit="submitForm()" method="get">
	Username: <input type = "text" id = "return_username" name = "return_username" required> <br>
	Password: <input type="password" id="return_password" name="return_password" required> <br>
	<input type="submit" name="return" value="Sign In"> <br>
</form>
</div>
<script>

var un = document.getElementById("return_username");
var pass = document.getElementById("return_password");
function submitForm(){
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "controller.php?return_username=" + un.value +"&return_password=" +pass.value, true);
	ajax.send();
	ajax.onreadystatechange = function(){
		//console.log("State: " + ajax.readyState);	
		if (ajax.readyState == 4 && ajax.status == 200) {
			if (ajax.responseText=="dne"){
				alert("Invalid credentials.");
			} else if (ajax.responseText=="wrong"){
				alert("Incorrect username or password.");
			} else {
				window.parent.login(ajax.responseText);
				window.parent.changePage("game.php");
			}
				
		}
	}
}
</script>


</body>
</html>

