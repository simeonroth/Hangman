<!DOCTYPE html>
<html>
<head>
<?php
session_start(); // Need this in each file before $_SESSION is used.
?>
<style>
#log {
    padding-top: 20px;
	display: inline-block;
	float: right;
}

.button2 {
	float: right;
}
h1{
    margin: 0;
    text-align: center;
    width: 100%;
    height: 90px;
    font-size: 70px;
    
}
h1::after {
	content: "";
	background: url(./images/headerBanner.png);
	background-size: 15%;
	opacity: 0.2;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	position: absolute;
	z-index: -1;
	height: 90px;
</style>


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
	<iframe frameBorder="0" src="home.php" name="iframe_a" scrolling="no"
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