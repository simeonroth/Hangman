<!DOCTYPE html>
<html>
<head>
<?php
session_start(); // Need this in each file before $_SESSION is used.
?>
<style>

</style>	

<!-- A Comment -->
<link rel="stylesheet" type="text/css" href="styles4.css" />
<link rel="stylesheet" type="text/css" href="styles2.css" />
</head>
<body>

<div id = "divToChange"></div>
<br><br><br>
<button id = "button1" onclick = "getLB()">See Frequent Players</button>
<br><br><br>
<div id = "divToChange2"></div>

<script>
var frequent = "frequent";
var array2  = new Array();
var string2 = "";
var element2 = document.getElementById("divToChange2");

var element = document.getElementById("divToChange");
var array = new Array();
var name;
var games;
var score;
var wins;
var losses;
var string = "";
	
var leaderboard = "leaderboard";
var ajax = new XMLHttpRequest();
ajax.open("GET", "controller.php?leaderboard=" + leaderboard, true);
ajax.send();
ajax.onreadystatechange = function(){
		//console.log("State: " + ajax.readyState);
	if (ajax.readyState == 4 && ajax.status == 200) {
		array = JSON.parse(ajax.responseText);
		
		string = "<table class = 'tablestyle'>" + "<tr><th>Username</th>" + "<th>Games Played</th>" + 
				 "<th>Wins</th>" + "<th>Losses</th>" + "<th>Total Score</th></tr>";

		for (var i = 0; i < array.length; ++i) {
			name = array[i]['username'];
			games = array[i]['totalGames'];
			scores = array[i]['totalScore'];
			wins = array[i]['Won'];
			losses = array[i]['Lost'];
				
			string += "<tr>" + "<td>" + name + "</td>" + 
					  "<td>" + games + "</td>" + 
					  "<td>" + wins + "</td>" + 
					  "<td>" + losses + "</td>" + 
					  "<td>" + scores + "</td>" + "</tr>";
				
		}
			string += "</table>";
			element.innerHTML = string;
	}
}

function getLB() {
	var ajax2 = new XMLHttpRequest();
	ajax2.open("GET", "controller.php?frequent=" + frequent, true);
	ajax2.send();
	ajax2.onreadystatechange = function(){
		if (ajax2.readyState == 4 && ajax2.status == 200) {
			array2 = JSON.parse(ajax2.responseText);
			string2 = "<table class = 'tablestyle'>" + "<tr><th>Username</th>" + "<th>Games Played</th></tr>";

			for (var i = 0; i < array2.length; ++i) {
				string2 += "<tr>" + "<td>" + array2[i]['username'] + "</td>" + 
				  		  "<td>" + array2[i]['totalGames'] + "</td>" + "</tr>";
			
			}
			string2 += "</table>";
			element.innerHTML = string2;
		}
	}
}
</script>


</body>
</html>