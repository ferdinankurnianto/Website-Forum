$("document").ready(function(){
	if(sessionStorage.getItem("mode")== "light"){
		lightmode();
	}
	else{
		darkmode();
	}
});
function lightmode() {
  var elementb = document.body;
  var elementh = document.getElementById("header");
  var elementn = document.getElementById("nav");
  var elementi = document.getElementById("mode");
  var elements = document.getElementById("side");
  var elementin = document.getElementsByClassName("container");
  var elementc = document.getElementsByClassName("card");
  var elementm = document.getElementsByClassName("modal-content");
  for (var i=0; i<elementin.length; i++){
	elementin[i].classList.remove("dark-mode1");
  }
  for (var i=0; i<elementm.length; i++){
	elementm[i].classList.remove("dark-mode1");
  }
  for (var i=0; i<elementc.length;i++){
	elementc[i].setAttribute("style","background:#C4C4C4; width: 18rem;");
  }
  elementb.classList.remove("dark-mode");
  elementh.classList.remove("dark-mode");
  elementn.classList.remove("bg-secondary");
  elementb.classList.add("light-mode");
  elementh.classList.add("light-mode");
  elementn.classList.add("bg-light");
  elementi.setAttribute("src", base_url+"/img/dark.png");
  elementi.setAttribute("onclick","darkmode()");
  if(elements!=null){
	elements.setAttribute("style","background:white");
  }
  sessionStorage.setItem("mode","light");
}
function darkmode() {
  var elementb = document.body;
  var elementh = document.getElementById("header");
  var elementn = document.getElementById("nav");
  var elementi = document.getElementById("mode");
  var elements = document.getElementById("side");
  var elementin = document.getElementsByClassName("container");
  var elementc = document.getElementsByClassName("card");
  var elementm = document.getElementsByClassName("modal-content");
  for (var i=0; i<elementin.length; i++){
	elementin[i].classList.add("dark-mode1");
  }
  for (var i=0; i<elementm.length; i++){
	elementm[i].classList.add("dark-mode1");
  }
  for (var i=0; i<elementc.length;i++){
	elementc[i].setAttribute("style","background:black; width: 18rem;");
  }
  elementb.classList.remove("light-mode");
  elementh.classList.remove("light-mode");
  elementn.classList.remove("bg-light");
  elementb.classList.add("dark-mode");
  elementh.classList.add("dark-mode");
  elementn.classList.add("bg-secondary");
  elementi.setAttribute("src",base_url+"/img/light.png");
  elementi.setAttribute("onclick","lightmode()");
  if(elements!=null){
	elements.setAttribute("style","background:dark");
  }
  sessionStorage.setItem("mode","dark");
}

function myFunction() {
  var x = document.getElementById("topnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}