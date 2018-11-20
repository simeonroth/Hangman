<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
<title>Hangman</title>
</head>
<body>
<h3>Hangman</h3><br>

<input id="input"></input>
<button onclick="guessLetter()">Guess</button>
<div id="div"></div>

<script type="text/javascript">
var word = "hangman";
var div = document.getElementById("div");
var input = document.getElementById("input");
var guess;
var hiddenWord;
var i;
initWord()
function guessLetter(){
	guess =  input.value;
	for (i=0;i<word.length;i++){
		if (guess == word[i]){
			hiddenWord[i]=guess;
		}
	}
	update();
}

function update(){
	div.innerHTML="";
	for (i=0;i<word.length;i++){
		div.innerHTML+=hiddenWord[i];
	}
	
}

function initWord(){
	hiddenWord = new Array(word.length);
	for (i=0;i<word.length;i++){
		hiddenWord[i]="_";
	}

}


</script>

</body>
</html>

