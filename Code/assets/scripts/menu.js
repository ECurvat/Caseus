let button = document.querySelector("#navbar-button");
let navbar = document.querySelector("#navbar");
let content = document.querySelector("#main");

// sidebar.innerHTML = navbar.innerHTML;

button.addEventListener("click", function (e) {
    e.preventDefault();
    navbar.classList.toggle("inactive");
    content.classList.toggle("inactive");
});
