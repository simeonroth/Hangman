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
<h1>Sign Up</h1>
<form onsubmit="submitForm()">
	<p class = "personalStylePage">Username: <input type = "text" id = "new_username" name = "new_username" required></p> <br>
	<p class = "personalStylePage">Password: <input type="password" id="new_password" name="new_password" required></p> <br>
	<input class = "personalStylePageB" type="submit" name="new" value="Sign Up"> <br> <br><br>
</form>
</div>

<script>
var un = document.getElementById("new_username");
var pass = document.getElementById("new_password");
function submitForm(){
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "controller.php?new_username=" + un.value +"&new_password=" +pass.value, true);
	ajax.send();
	ajax.onreadystatechange = function(){
		//console.log("State: " + ajax.readyState);	
		if (ajax.readyState == 4 && ajax.status == 200) {
			if (ajax.responseText=="taken"){
				alert("Username not available.");
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

