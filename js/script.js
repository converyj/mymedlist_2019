// for the hamburger button
var hamburger = document.getElementById("icon"); 

hamburger.addEventListener("click", showNav, false);

function showNav() {
	var nav = document.getElementById("navBar");
	if (nav.className === "nav") {
		nav.className += " responsive"; 
	} else {
		nav.className = "nav"; 
	}
}



