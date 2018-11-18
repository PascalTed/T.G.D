// Début menu burger
var headerBurgerIcon = document.getElementById('header-burger-icon');
var headerMenu = document.getElementById('header-menu');

document.getElementById('header-burger-icon').addEventListener('click', function (e) {
    
    if (!e.target.classList.contains("open")){
        e.target.classList.add("open");
        headerMenu.classList.add("open");
    } else {
        e.target.classList.remove("open");
        headerMenu.classList.remove("open");
    }
});

var mediaQuery = window.matchMedia("(max-width: 500px)");

mediaQuery.addListener(function() {
    if(!mediaQuery.matches) {
        headerBurgerIcon.classList.remove("open");
        headerMenu.classList.remove("open");
    } 
});
// Fin menu burger