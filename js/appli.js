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

// Début vérification infos création compte. Si le pseudo et le mail n'existe pas, le compte est créé
var formRegistration = document.getElementById("form-registration");

var messagePseudo = document.getElementById("alertPseudo");
var messageEmail = document.getElementById("alertEmail");
var messagePass = document.getElementById("alertPassword");
var messageVerifPass = document.getElementById("alertVerifPassword");

if (formRegistration !== null) {
    
    formRegistration.addEventListener("submit", function (e) {    
        e.preventDefault();
            
        var userCreate = document.getElementById("pseudo").value;
        var emailCreate = document.getElementById("email").value;
        var mdpValue = document.getElementById("password").value;
        var verifMdpValue = document.getElementById("verifPassword").value;

        var regexSpec = Object.create(Regex);
        regexSpec.init(/\W+/, mdpValue);
        
        var regexChiffre = Object.create(Regex);
        regexChiffre.init(/\d+/, mdpValue);
        
        var dataSend = 'pseudo='+ encodeURIComponent(userCreate) + '&email=' + encodeURIComponent(emailCreate);
        var ajaxPostCreate = Object.create(AjaxPost);
        
        ajaxPostCreate.init("index.php?action=verifCreateAccount", dataSend, function(reponse) {

            if (reponse === "existUser") {

                messagePseudo.textContent = "Pseudo déjà existant";
                document.getElementById("pseudo").addEventListener("click", function () {
                    messagePseudo.textContent = "";
                });
            }
            if (reponse === "existEmail") {
                
                messageEmail.textContent = "email déjà existant";
                document.getElementById("email").addEventListener("click", function () {
                    messageEmail.textContent = "";
                });
            }
            if (reponse === "valide") {
                if (regexSpec.verifier() === true) { 
                    if (regexChiffre.verifier() === true) { 
                        if (mdpValue === verifMdpValue) { 
                            formRegistration.submit();
                        } else {
                            messageVerifPass.textContent = "Les mots de passe ne sont pas identiques";
                            document.getElementById("verifPassword").addEventListener("click", function () {
                                messageVerifPass.textContent = "";
                                messagePass.textContent = "";
                            });
                        }    
                    } else {
                        messagePass.textContent = "Il faut au minimum un chiffre";
                        document.getElementById("password").addEventListener("click", function () {
                            messagePass.textContent = "";
                            messageVerifPass.textContent = "";
                        });
                    }        
                } else {
                    messagePass.textContent = "Il faut au minimum un caractère spécial"; 
                    document.getElementById("password").addEventListener("click", function () {
                        messagePass.textContent = "";
                        messageVerifPass.textContent = "";
                    });
                }
            }
        });
        ajaxPostCreate.executer();    
    });
}
// Fin vérification infos création compte. Si le pseudo et le mail n'existe pas, le compte est créé

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