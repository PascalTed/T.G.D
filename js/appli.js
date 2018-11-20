// Début menu burger
var headerBurgerIcon = document.getElementById('header-burger-icon');
var headerMenu = document.getElementById('header-menu');

headerBurgerIcon.addEventListener('click', function (e) {
    
    if (!headerBurgerIcon.classList.contains("open")){
        e.currentTarget.classList.add("open");
        headerMenu.classList.add("open");
    } else {
        e.currentTarget.classList.remove("open");
        headerMenu.classList.remove("open");
    }
});

var mediaQuery = window.matchMedia("(max-width: 600px)");

mediaQuery.addListener(function(changed) {
    if(!mediaQuery.matches) {
        headerBurgerIcon.classList.remove("open");
        headerMenu.classList.remove("open")
    } 
});
// Fin menu burger

// Début affichage de la fenêtre de connexion
var loginWindow = document.getElementById("login-window");
var opaqueWindow = document.getElementById("opaque-window");
var menuConnect = document.getElementById("menu-connect");

if (menuConnect !== null) {
    
    menuConnect.addEventListener("click", function() {
        loginWindow.style.display = "block";
        opaqueWindow.style.display = "block";
                
        opaqueWindow.addEventListener("click", function() {
            opaqueWindow.style.display = "none";
            loginWindow.style.display = "none";
        });
    }); 
}

var closeWindowLogin = document.getElementById("close-window-login");

    closeWindowLogin.addEventListener("click", function() {
        loginWindow.style.display = "none";
        opaqueWindow.style.display = "none";
    });
// Fin affichage de la fenêtre de connexion