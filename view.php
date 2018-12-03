<!DOCTYPE html>
<html>
<head>
<?php
header('P3P: CP="CAO PSA OUR"');
session_start (); // Need this in each file before $_SESSION is used.
?>
<style>

</style>	


<link rel="stylesheet" type="text/css" href="styles3.css" />
</head>
<body>
<h1 align="center">Hangman</h1>
<div class ="banner" >
<img onclick="changePage('game.php')" src="./images/buttonPlay.png" id="button"></img>
<img  onclick="changePage('leaderboards.php')" src="./images/buttonLeaderboards.png" id="button"></img>
</div>
<iframe frameBorder="0" src="register.php" name="iframe_a" scrolling="no" id="iframe">

<p>Working</p>


</iframe>


<script>
var iframe = document.getElementById("iframe");
var curPage;
function changePage(n){
	if (n===curPage){
		;
	} else {
		curPage=n
		iframe.src=n;
	}
	
}
</script>
</body>
</html>