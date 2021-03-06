<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
<link rel="stylesheet" type="text/css" href="styles2.css" />

<title>Hangman</title>
<?php
session_start (); // Need this in each file before $_SESSION is used.
?>
<style>

</style>

</head>
<body>
 <div id="messages" class = "size">&nbsp;</div>
 <div class = "col1">
 
<canvas id="myCanvas" width="300" height="320">Your browser does not support the HTML5 canvas tag.</canvas><br><br>
<!-- <div class = "size" id="div"></div><br> -->

<br>
<div id = "lines" class = "size"></div> <br><br><br>


</div>
 
 
<div class = "col2">
 <div id="ic" class= "size">Tries Left: </div>
 <div id="score" class="size">Score: </div>
 
<!--  <div class = "size" id="random" ></div><br>-->


<div id="guessesBox" class="grid-container">
  <div class="grid-item" id="1g" >a</div>
  <div class="grid-item" id="2g" >b</div>
  <div class="grid-item" id="3g" >c</div>
  <div class="grid-item" id="4g" >d</div>
  <div class="grid-item" id="5g" >e</div>
  <div class="grid-item" id="6g" >f</div>
  <div class="grid-item" id="7g" >g</div>
  <div class="grid-item" id="8g" >h</div>
  <div class="grid-item" id="9g" >i</div>
  <div class="grid-item" id="10g" >j</div>
  <div class="grid-item" id="11g" >k</div>
  <div class="grid-item" id="12g" >l</div>
  <div class="grid-item" id="13g" >m</div>
  <div class="grid-item" id="14g" >n</div>
  <div class="grid-item" id="15g" >o</div>
  <div class="grid-item" id="16g" >p</div>
  <div class="grid-item" id="17g" >q</div>
  <div class="grid-item" id="18g" >r</div>
  <div class="grid-item" id="19g" >s</div>
  <div class="grid-item" id="20g" >t</div>
  <div class="grid-item" id="21g" >u</div>
  <div class="grid-item" id="22g" >v</div>
  <div class="grid-item" id="23g" >w</div>
  <div class="grid-item" id="24g" >x</div>
  <div class="grid-item" id="25g" >y</div>
  <div class="grid-item" id="26g" >z</div>
</div>

<img  onclick="guessLetter()" src="./images/buttonGuess.png" id="button" >
<input type="text" id="input" size="1" maxlength="1" ></input><br>

<img  onclick="newGame()" src="./images/buttonNewGame.png" id="button"><br>

</div>

<div class="col2">

<div class="size" id="wins">
Wins: 
</div>

<div class="size" id="losses">
Losses: 
</div>
 
<div class="size" id="tscore">
Total Score: 
</div>
 
<div class="size" id="gmess">
(login to see stats)
</div>

</div>
<br>
<br>




<script type="text/javascript">
var c = document.getElementById("myCanvas");
c.style.border = "none";
var guessBox = document.getElementById("guessesBox");
var button = document.getElementById("button");
var ctx = c.getContext("2d");
var letterGuesses;
var attempts = 0;
var maxGuesses=7;
var lines = document.getElementById("lines");
var messages = document.getElementById("messages");
var div = document.getElementById("div");
var input = document.getElementById("input");
var guess;
var hiddenWord;
var i;
var correctGuess = 0;
var e;
var word = "";
//var element = document.getElementById("random");
//var element2 = document.getElementById("random2");
var ic = document.getElementById("ic");
var sc = document.getElementById("score");
var score;

var username = "";
var result = "";
var points;

var winDisplay = document.getElementById("wins");
var loseDisplay = document.getElementById("losses");
var scoreDisplay = document.getElementById("tscore");
var guestDisplay = document.getElementById("gmess");
///////////////////////////////////////////////////////
username = window.parent.username;

newGame();
//this starts a new game
	
function newGame(){
	if (attempts != maxGuesses) {
		if (!ifOver()){
			points = (-20) * word.length;
			checkEnd("L", points ,username);
		}
	}
	
	var display = "display";
	var array2 = new Array();
	var ajax2 = new XMLHttpRequest();
	ajax2.open("GET", "controller.php?display=" + display + "&d_un=" + username, true);
	ajax2.send();
	ajax2.onreadystatechange = function(){
		if (ajax2.readyState == 4 && ajax2.status == 200) {
			array2 = JSON.parse(ajax2.responseText);
				
			winDisplay.innerHTML = "Wins: " + array2[0]['Won'];
			loseDisplay.innerHTML = "Losses: " + array2[0]['Lost'];
			scoreDisplay.innerHTML = "Total Score: " + array2[0]['totalScore'];
			guestDisplay.innerHTML = "";
		}
	}




	////////////////////////////////////////////////
	score=0;
	initGuessBox();
	drawGuessBox();
	var start = "startGame";
	var array = new Array();
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "controller.php?start=" + start, true);
	ajax.send();
	ajax.onreadystatechange = function(){
		//console.log("State: " + ajax.readyState);
		if (ajax.readyState == 4 && ajax.status == 200) {
			//setting up the game
			array = JSON.parse(ajax.responseText);
			word = array[Math.floor(Math.random() * array.length)];
			//element.innerHTML = word;
			initLines();
			initWord();
		}
	}

	messages.innerHTML="";
	attempts=0;
	ic.innerHTML="Tries Left: " + (maxGuesses - attempts);
	sc.innerHTML="Score: " + score;
	ctx.clearRect(0, 0, 300, 300);
	
	drawHangman();
	input.value=""; 
	input.disabled=false;
	button.onclick=guessLetter;
}
function initLines(){
	var d;
	lines.innerHTML="";
	for (i=0;i<word.length;i++){
		d = document.createElement("div");
		d.innerHTML='';
		d.classList.add('line');
		d.id = i.toString();
		lines.appendChild(d);
	}
	
}
function initGuessBox(){
	letterGuesses = new Array(26);
	for (i=0;i<26;i++){
		letterGuesses[i] = "&nbsp";
	}
}
function drawGuessBox(){
	
	for (i=1;i<27;i++){
		e = document.getElementById(i.toString() + 'g');
		e.innerHTML = letterGuesses[i-1];
	}
	
}
//makes a letter guess when the user inputs a letter
function guessLetter(){ 
	messages.innerHTML = "";
	guess =  input.value.toLowerCase();
	if (letterGuesses.includes(guess)){
		messages.innerHTML="You've already guessed " + guess + "!";
		input.value="";
		return;
	}
	if (!guess.match(/^[a-zA-Z]+$/i)){ // checks if what is entered is a letter;may replace with form submission
		return;
	}
	for (i=0;i<word.length;i++){ // checks if the guessed letter is in the word and updates array
		if (guess == word[i]){
			hiddenWord[i]=guess;
			correctGuess=1;
		}
	}
	if (!correctGuess){ // if youre guess is wrong
		score = score-20;
		attempts ++;
		drawHangman();
		if (attempts==maxGuesses){ // lose conditional
			messages.innerHTML='You Lose. The word was "' + word +'"';
			input.value="";
			input.disabled=true;
			
			button.onclick="";

			//////////////ajax call/////////////////////
			result = "L";
			checkEnd(result, score, username);
					
			
		}
	} else {
		score+=40;
		if (ifOver()){ // if game is won
			messages.innerHTML="You Win!";
			//input.value="";
			input.disabled=true;
			
			button.onclick="";
			
			//////////////ajax call/////////////////////
			result = "W";
			checkEnd(result, score, username);
		}
	}
	letterGuesses[guess.charCodeAt(0)-'a'.charCodeAt(0)]=guess;
	drawGuessBox();
	ic.innerHTML="Tries Left: " + (maxGuesses - attempts);
	sc.innerHTML="Score: " + score;
	correctGuess=0;
	input.value=""; // clears the input field
	update(); // updates array display
}
//draws parts of the hangman based on number of attempts
function drawHangman(){
	ctx.beginPath();
	if (attempts==0){ // draws hanging platform
		ctx.moveTo(50, 299);
		ctx.lineTo(250, 299);
		ctx.stroke();
		ctx.moveTo(80, 299);
		ctx.lineTo(80, 50);
		ctx.moveTo(80, 50);
		ctx.lineTo(160, 50);
	}else if (attempts==1){ // draws noose
		ctx.moveTo(160, 50);
		ctx.lineTo(160, 80);
	} else if (attempts==2){ // draws head
		ctx.beginPath();
		ctx.arc(160,100,20,0,2*Math.PI);
	} else if (attempts==3){ // draws body
		ctx.moveTo(160, 120);
		ctx.lineTo(160, 180);
	}else if (attempts==4){ // draws right arm
		ctx.moveTo(160, 140);
		ctx.lineTo(190, 130);
	}else if (attempts==5){ // draws left arm
		ctx.moveTo(160, 140);
		ctx.lineTo(130, 130);
	}else if (attempts==6){ // draws right leg
		ctx.moveTo(160, 180);
		ctx.lineTo(180, 200);
	}else if (attempts==7){ // draws left leg
		ctx.moveTo(160, 180);
		ctx.lineTo(140, 200);
	}
	ctx.closePath();
	ctx.stroke();
}
// checks if word has been guessed
function ifOver(){
	for (i=0;i<word.length;i++){
		if (hiddenWord[i]!=word[i])
			return false;
	}
	return true;
}
//updates the div 
function update(){
	var d;
	for (i=0;i<word.length;i++){
		d = document.getElementById(i.toString());
		d.innerHTML=hiddenWord[i];
	}
}
//initializes a new word
function initWord(){
	hiddenWord = new Array(word.length);
	for (i=0;i<word.length;i++){
		hiddenWord[i]="&nbsp";
	}
	update();
}
function checkEnd(result, score, username) {
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "controller.php?username=" + username + "&result=" + result + "&score=" + score, true);
	ajax.send();
	ajax.onreadystatechange = function(){
		//console.log("State: " + ajax.readyState);
		if (ajax.readyState == 4 && ajax.status == 200) {
			//element2.innerHTML = ajax.responseText;
			//do something with username
		}
	}
}
</script>

</body>
</html>