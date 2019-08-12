// Generate the date to show in fields
date = document.getElementById("date").valueAsDate = new Date();

input = document.getElementsByClassName("myInput");

for (var i = 0; i<input.length; i++) {
	input[i].addEventListener('keyup', filter, false);
} 