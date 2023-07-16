document.addEventListener("DOMContentLoaded", function() {
  var loadingContainer = document.getElementById("loading-container");
  var signupContainer = document.querySelector(".container");
  var signupForm = document.getElementById(".form-container sign-up-container");

  
  signupContainer.style.opacity = "0";

 
  setTimeout(function() {
    loadingContainer.style.opacity = "0";
    loadingContainer.style.pointerEvents = "none";
    signupContainer.style.opacity = "1";
    signupContainer.style.pointerEvents = "auto";
  }, 3000);

});


const loadingContainer = document.getElementById('loading-container');


window.addEventListener('load', function() {
  loadingContainer.style.display = 'flex';
});


window.addEventListener('beforeunload', function() {
  loadingContainer.style.display = 'flex';
});

// Hide the loading animation when the page is fully loaded
document.addEventListener('DOMContentLoaded', function() {
  loadingContainer.style.display = 'none';
});

// Hide the loading animation when the user clicks the back button
window.addEventListener('popstate', function() {
  loadingContainer.style.display = 'none';
});







////////LOGIN PAGE



const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

