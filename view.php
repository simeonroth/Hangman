<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
<title>Hangman</title>
<?php
session_start (); // Need this in each file before $_SESSION is used.
?>
</head>
<body>
<h1>Hangman</h1><br>

<div id = "random"></div> <!-- So you can see what word is picked at random -->

<canvas id="myCanvas" width="300" height="300">
Your browser does not support the HTML5 canvas tag.</canvas><br><br>

<div id="div"></div><br>
<input type="text" id="input" size="1" maxlength="1" ></input>
<img  onclick="guessLetter()" src="./images/buttonGuess.png" id="button"><br><br>

<div id="messages"></div><br><br>
<img  onclick="newGame()" src="./images/buttonNewGame.png" id="button">



<script type="text/javascript">
var c = document.getElementById("myCanvas");
c.style.border = "none";
var button = document.getElementById("button");
var ctx = c.getContext("2d");

var attempts;
var maxGuesses=7;

var messages = document.getElementById("messages");
var div = document.getElementById("div");
var input = document.getElementById("input");

var guess;
var hiddenWord;
var i;
var correctGuess = 0;


var word = "";
var element = document.getElementById("random");

///////////////////////////////////////////////////////

newGame();

//this starts a new game
function newGame(){ 
	var array = new Array();
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "controller.php", true);
	ajax.send();

	ajax.onreadystatechange = function(){
		console.log("State: " + ajax.readyState);
		if (ajax.readyState == 4 && ajax.status == 200) {
			//setting up the game
			array = JSON.parse(ajax.responseText);
			word = array[Math.floor(Math.random() * array.length)];
			element.innerHTML = word;
			initWord();
		}
	}
	
	messages.innerHTML="";
	attempts=0;
	
	ctx.clearRect(0, 0, 300, 300);
	drawHangman();
	input.value=""; 
	input.disabled=false;
	button.disabled=false;

}

//makes a letter guess when the user inputs a letter
function guessLetter(){ 
	guess =  input.value.toLowerCase();
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
		attempts ++;
		messages.innerHTML="You've made "+ attempts +" incorrect guesse(s)";
		drawHangman();
		if (attempts==maxGuesses){ // lose conditional
			messages.innerHTML="You Lose";
			input.disabled=true;
			button.disabled=true;
		}
	} else {
		if (ifOver()){ // if game is won
			messages.innerHTML="You Win";
			input.disabled=true;
			button.disabled=true;
		}
	}
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
	div.innerHTML="";
	for (i=0;i<word.length;i++){
		div.innerHTML+=hiddenWord[i]+" ";
	}
}

//initializes a new word
function initWord(){
	hiddenWord = new Array(word.length);
	for (i=0;i<word.length;i++){
		hiddenWord[i]="_";
	}
	update();
}


</script>

</body>
</html>

