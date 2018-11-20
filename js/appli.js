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

// Début connexion //
// Début affichage de la fenêtre de connexion
var loginWindow = document.getElementById("login-window");
var opaqueWindow = document.getElementById("opaque-window");
var menuConnect = document.getElementById("header-menu-connect");

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

var closeLoginWindow = document.getElementById("close-login-window");

    closeLoginWindow.addEventListener("click", function() {
        loginWindow.style.display = "none";
        opaqueWindow.style.display = "none";
    });
// Fin affichage de la fenêtre de connexion

// Début vérification login connexion. Si le pseudo et le mot de passe associé sont exactes, on se connecte
var formLoginWindow = document.getElementById('form-login-window');

formLoginWindow.addEventListener("submit", function(e) {
    
    e.preventDefault();
    
    var User = document.getElementById('pseudo-connect').value;
    var Pass = document.getElementById('password-connect').value;
    var dataSend = 'pseudo-connect='+ encodeURIComponent(User) + '&password-connect=' + encodeURIComponent(Pass);
    
    var ajaxPostConnect = Object.create(AjaxPost);
    
    ajaxPostConnect.init("index.php?action=connectAccount", dataSend, function(reponse) {

        if (reponse === "noUser" || reponse === "noPass") {
            document.getElementById("pseudo-pass-alert").textContent = "Pseudo ou mot de passe incorrect";
            
            document.getElementById("pseudo-connect").addEventListener("click", function () {
                document.getElementById("pseudo-pass-alert").textContent = "";
            });
            document.getElementById("password-connect").addEventListener("click", function () {
                document.getElementById("pseudo-pass-alert").textContent = "";
            });
        }
        if (reponse === "valid") {
            formLoginWindow.submit();
        }
    });
    ajaxPostConnect.executer();
});
// Fin vérification login connexion. Si le pseudo et le mot de passe associé sont exactes, on se connecte

// Fin connexion //