
<!DOCTYPE html>
<html>
<head>
<title>Hangman</title>
</head>
<body>
<h3>Hangman</h3><br>

<input id="input" size="1" maxlength="1"></input>
<button onclick="guessLetter()">Guess</button>
<div id="div"></div>
<div id="messages"></div>

<script type="text/javascript">
var attempts=0;
var word = "hangman";
var messages = document.getElementById("messages");
var div = document.getElementById("div");
var input = document.getElementById("input");
var guess;
var hiddenWord;
var i;
var correctGuess = 0;
initWord();
function guessLetter(){
	guess =  input.value;
	for (i=0;i<word.length;i++){
		if (guess == word[i]){
			hiddenWord[i]=guess;
			correctGuess=1;
		}
	}
	if (!correctGuess){
		attempts ++;
		messages.innerHTML="youve made "+attempts+" incorrect guesses";
		
		if (attempts>4){
			messages.innerHTML="you Lose";
			input.disabled=true;
		}
	} else {
		if (ifOver()){
			messages.innerHTML="you Win";
			input.disabled=true;
		}
	}
	correctGuess=0;
	update();
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

