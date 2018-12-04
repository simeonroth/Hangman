<!DOCTYPE html>
<html>
<head>
<?php
session_start(); // Need this in each file before $_SESSION is used.
?>


<link rel="stylesheet" type="text/css" href="styles3.css" />


</head>
<body>
	<h1 >Hangman</h1>
	<div class="banner" id="ban">
		<img onclick="changePage('game.php')" src="./images/buttonPlay.png"
			id="button"></img> 
		<img onclick="changePage('leaderboards.php')" src="./images/buttonLeaderboards.png" 
			id="button"></img>
			
		<div id='log'>Logged in <br>as guest</div>
		
		<img class="button2" onclick="changePage('signUp.php')"
			src="./images/buttonSignup.png" id="button"></img> 
		<img class="button2" onclick="changePage('signIn.php')"
			src="./images/buttonLogin.png" id="button"></img>


	</div>
	<iframe style="visibility:hidden;" onload="this.style.visibility = 'visible';"  frameBorder="0" src="home.php" name="iframe_a" 
		id="iframe"></iframe>


	<script>
var iframe = document.getElementById("iframe");
var curPage;
var banner =document.getElementById("ban");
var username;
var log=document.getElementById("log");
function changePage(n){
	if (n===curPage){
		;
	} else {
		curPage=n;
		iframe.src=n;
	}
	
}
function login(n){
	username=n;
	
	banner.innerHTML='<img onclick="changePage(\'game.php\')" src="./images/buttonPlay.png"id="button"></img> <img onclick="changePage(\'leaderboards.php\')"src="./images/buttonLeaderboards.png" id="button"></img>';
	banner.innerHTML+='<div id=\'log\'>logged in as guest</div>';
	banner.innerHTML+='<img class = "button2" onclick="signOut()" src="./images/buttonSignout.png"id="button"></img>';
	log=document.getElementById("log");
	log.innerHTML="Welcome " + "<br>" + username + "!";
}
function signOut(){
	username="";
	banner.innerHTML='<img onclick="changePage(\'game.php\')" src="./images/buttonPlay.png"id="button"></img> <img onclick="changePage(\'leaderboards.php\')"src="./images/buttonLeaderboards.png" id="button"></img>';
	banner.innerHTML+='<div id=\'log\'>logged in as guest</div>';
	banner.innerHTML+='<img class="button2" onclick="changePage(\'signUp.php\')" src="./images/buttonSignup.png" id="button"></img>';
	banner.innerHTML+='<img class="button2" onclick="changePage(\'signIn.php\')" src="./images/buttonLogin.png" id="button"></img>';
	log=document.getElementById("log");
	log.innerHTML="Logged in <br> as guest";
	changePage("home.php");
}
</script>
</body>
</html>