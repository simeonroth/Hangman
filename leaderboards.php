<!DOCTYPE html>
<html>
<head>
<?php
session_start(); // Need this in each file before $_SESSION is used.
?>
<style>

</style>	


<link rel="stylesheet" type="text/css" href="styles4.css" />
<link rel="stylesheet" type="text/css" href="styles2.css" />
</head>
<body>

<button id = "button1" onclick = "getLB()">Click to see Leaderboard</button> <br><br>

<div id = "divToChange"></div>


<script>
var element = document.getElementById("divToChange");

function getLB() {
	var array = new Array();
	var name;
	var games;
	var score;
	var string = "";
	
	var leaderboard = "leaderboard";
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "controller.php?leaderboard=" + leaderboard, true);
	ajax.send();
	ajax.onreadystatechange = function(){
		//console.log("State: " + ajax.readyState);
		if (ajax.readyState == 4 && ajax.status == 200) {
			array = JSON.parse(ajax.responseText);

			string = "<table class = 'tablestyle'>" + "<tr><th>Username</th>" + 
					 "<th>Games Played</th>" + "<th>Total Score</th></tr>";
			for (var i = 0; i < array.length; ++i) {
				name = array[i]['username'];
				games = array[i]['totalGames'];
				scores = array[i]['totalScore'];
				
				string += "<tr>" + "<td>" + name + "</td>" + 
						  "<td>" + games + "</td>" + 
						  "<td>" + scores + "</td>" + "</tr>";
				
			}
			string += "</table>";
			element.innerHTML = string;
		}
	}
	
}
</script>


</body>
</html>