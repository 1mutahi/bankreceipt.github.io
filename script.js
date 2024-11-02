document.addEventListener("DOMContentLoaded", function() {
    const authForm = document.getElementById("auth-form");
    const loginForm = document.getElementById("login-form");
    const toggleLink = document.getElementById("toggle-link");
    const toggleLinkLogin = document.getElementById("toggle-link-login");
  
    // Show login form
    toggleLink.addEventListener("click", function(event) {
        event.preventDefault();
        authForm.style.display = "none"; // Hide registration form
        loginForm.style.display = "block"; // Show login form
        document.getElementById("form-title").textContent = "Log In"; // Update title
    });
  
    // Show registration form
    toggleLinkLogin.addEventListener("click", function(event) {
        event.preventDefault();
        loginForm.style.display = "none"; // Hide login form
        authForm.style.display = "block"; // Show registration form
        document.getElementById("form-title").textContent = "Create Account"; // Update title
    });
  });