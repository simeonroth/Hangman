<!DOCTYPE html>
<html>
<head>
<title>Hangman</title>
</head>
<body>
<h3>Hangman</h3><br>


<canvas id="myCanvas" width="300" height="300" ;">
Your browser does not support the HTML5 canvas tag.</canvas><br><br>

<div id="div"></div><br>
<input type="text" id="input" size="1" maxlength="1" ></input>
<button onclick="guessLetter()" id="button">Guess</button><br><br>
<div id="messages"></div><br><br>
<button onclick="newGame()" id="button">New Game</button>



<script type="text/javascript">
var c = document.getElementById("myCanvas");
c.style.border = "none";
var button = document.getElementById("button");
var ctx = c.getContext("2d");
var attempts;
var maxGuesses=7;
var word = "fiction";
var messages = document.getElementById("messages");
var div = document.getElementById("div");
var input = document.getElementById("input");
var guess;
var hiddenWord;
var i;
var correctGuess = 0;
newGame();

function newGame(){
	messages.innerHTML="";
	attempts=0;
	initWord();
	ctx.clearRect(0, 0, 300, 300);
	drawHangman();
	input.value="";
	input.disabled=false;
	button.disabled=false;
}
function guessLetter(){
	guess =  input.value.toLowerCase();
	if (!guess.match(/^[a-zA-Z]+$/i)){
		return;
	}
	for (i=0;i<word.length;i++){
		if (guess == word[i]){
			hiddenWord[i]=guess;
			correctGuess=1;
		}
	}
	if (!correctGuess){
		attempts ++;
		messages.innerHTML="youve made "+attempts+" incorrect guesses";
		drawHangman();
		if (attempts==maxGuesses){
			messages.innerHTML="you Lose";
			input.disabled=true;
			button.disabled=true;
		}
	} else {
		if (ifOver()){
			messages.innerHTML="you Win";
			input.disabled=true;
			button.disabled=true;
		}
	}
	correctGuess=0;
	input.value="";
	update();
}

function drawHangman(){
	ctx.beginPath();
	if (attempts==0){
		ctx.moveTo(50, 299);
		ctx.lineTo(250, 299);
		ctx.stroke();

		ctx.moveTo(80, 299);
		ctx.lineTo(80, 50);
		ctx.moveTo(80, 50);
		ctx.lineTo(160, 50);
	}else if (attempts==1){
		ctx.moveTo(160, 50);
		ctx.lineTo(160, 80);
	} else if (attempts==2){
		ctx.beginPath();
		ctx.arc(160,100,20,0,2*Math.PI);
	} else if (attempts==3){
		ctx.moveTo(160, 120);
		ctx.lineTo(160, 180);
	}else if (attempts==4){
		ctx.moveTo(160, 140);
		ctx.lineTo(190, 130);
	}else if (attempts==5){
		ctx.moveTo(160, 140);
		ctx.lineTo(130, 130);
	}else if (attempts==6){
		ctx.moveTo(160, 180);
		ctx.lineTo(180, 200);
	}else if (attempts==7){
		ctx.moveTo(160, 180);
		ctx.lineTo(140, 200);
	}
	ctx.closePath();
	ctx.stroke();
}

function ifOver(){
	for (i=0;i<word.length;i++){
		if (hiddenWord[i]!=word[i])
			return false;
	}
	return true;
}

function update(){
	div.innerHTML="";
	for (i=0;i<word.length;i++){
		div.innerHTML+=hiddenWord[i]+" ";
	}
}

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

