// print medication lists 
var printBtn = document.getElementById("print"); 

var list = document.getElementById("toPDF"); 

printBtn.addEventListener("click", printContent, false);

function printContent() {
	var oldPage = document.body.innerHTML;
	var list = document.getElementById("toPDF").innerHTML; 
	document.body.innerHTML = list; 
	window.print(); 
	console.log(list);
	document.body.innerHTML = oldPage;  
}

// emailing list display
var mail = document.getElementById("mail"); 

function mailTo(email, subject) {
	
	var newLine = "%0D%0A"; 
	var line = "%5F%5F%5F%5F%5F%5F%5F%5F%5F%5F%5F%5F%5F";
 
	var thTags = document.getElementsByTagName("th");
	var tdTags = document.getElementsByTagName("td");

	var body = ""; 

	body += "Here is the latest list of medications.";
	body += newLine;
	body += newLine;
	body += thTags[0].innerHTML; 
	body += newLine;
	body += line; 
	body += line; 
	body += newLine;
	body += newLine;
	for (var i = 0; i < tdTags.length; i+=4) {
		body += tdTags[i].innerHTML; 
		body += newLine;
	} 
	body += newLine;
	body += newLine;

	var aTag = document.getElementById("mail"); 
	aTag.setAttribute("href", "mailto:" + email + "?subject=" + subject + "&body=" + body);
}