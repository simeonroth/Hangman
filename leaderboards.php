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
<br>
<h1>Top Players</h1>
<div id = "divToChange"></div>
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
		console.log("Hi");
		string = "<table class = 'tablestyle'>" + 
				 "<tr><th>Rank</th>" + 
				 "<th>Username</th>" + 
				 "<th onclick = 'getLB(\"totalGames\")'>Games Played</th>" + 
				 "<th onclick = 'getLB(\"Won\")'>Wins</th>" + 
				 "<th onclick = 'getLB(\"Lost\")'>Losses</th>" + 
				 "<th onclick = 'getLB(\"totalScore\")'>Total Score</th></tr>";

		for (var i = 0; i < array.length ;++i) {
			name = array[i]['username'];
			games = array[i]['totalGames'];
			scores = array[i]['totalScore'];
			wins = array[i]['Won'];
			losses = array[i]['Lost'];
				
			string += "<tr>" + "<td>" + (i+1) + "</td>" + 
					  "<td>" + name + "</td>" + 
					  "<td>" + games + "</td>" + 
					  "<td>" + wins + "</td>" + 
					  "<td>" + losses + "</td>" + 
					  "<td>" + scores + "</td>" + "</tr>";
				
		}
			string += "</table>";
			element.innerHTML = string;
	}
}

function getLB(headerCol) {
	console.log("Check");
	var ajax2 = new XMLHttpRequest();
	ajax2.open("GET", "controller.php?frequent=" + frequent + "&col=" + headerCol, true);
	ajax2.send();
	ajax2.onreadystatechange = function(){
		if (ajax2.readyState == 4 && ajax2.status == 200) {
			array2 = JSON.parse(ajax2.responseText);
			
			string2 = "<table class = 'tablestyle'>" + 
			 		 "<tr><th>Rank</th>" + 
			         "<th>Username</th>" + 
					 "<th onclick = 'getLB(\"totalGames\")'>Games Played</th>" + 
					 "<th onclick = 'getLB(\"Won\")'>Wins</th>" + 
					 "<th onclick = 'getLB(\"Lost\")'>Losses</th>" + 
					 "<th onclick = 'getLB(\"totalScore\")'>Total Score</th></tr>";

			for (var i = 0; i < array2.length ;++i) {
				name = array2[i]['username'];
				games = array2[i]['totalGames'];
				scores = array2[i]['totalScore'];
				wins = array2[i]['Won'];
				losses = array2[i]['Lost'];
			
				string2 += "<tr>" + "<td>" + (i+1) + "</td>" + 
				  	  	  "<td>" + name + "</td>" + 
				  	  	  "<td>" + games + "</td>" + 
				  	  	  "<td>" + wins + "</td>" + 
				  	  	  "<td>" + losses + "</td>" + 
				  	      "<td>" + scores + "</td>" + "</tr>";
			
			}
				string2 += "</table>";
				element.innerHTML = string2;
		}
	}
}

</script>


</body>
</html>