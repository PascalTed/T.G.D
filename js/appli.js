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

var mediaQuery = window.matchMedia("(max-width: 800px)");

mediaQuery.addListener(function(changed) {
    if(!mediaQuery.matches) {
        headerBurgerIcon.classList.remove("open");
        headerMenu.classList.remove("open")
    } 
});
// Fin menu burger

// Début vérification infos création compte. Si le pseudo et le mail n'existe pas, le compte est créé
var formRegistration = document.getElementById("form-registration");

var formInputPseudo = document.getElementById("pseudo");
var formInputEmail = document.getElementById("email");
var formInputPass = document.getElementById("password");
var formInputVerifPass = document.getElementById("verif-password");

var messagePseudo = document.getElementById("alert-pseudo");
var messageEmail = document.getElementById("alert-email");
var messagePass = document.getElementById("alert-password");
var messageVerifPass = document.getElementById("alert-verif-password");

var pseudoVerified;
var emailVerified;
var passVerified;

if (formRegistration !== null) {
    
    formInputPseudo.value = "";
    formInputEmail.value = "";
    // Vérification pseudo
    formInputPseudo.addEventListener("input", function () {
        console.log("envois");
        var dataSend = 'pseudo='+ encodeURIComponent(formInputPseudo.value);
        var ajaxPostPseudo = Object.create(AjaxPost);
        
        ajaxPostPseudo.init("index.php?action=verifPseudoCreateAccount", dataSend, function(reponse) {
            console.log(reponse);
            if (reponse === "existUser") {
                messagePseudo.classList.add("red-message");
                messagePseudo.textContent = "pseudo déjà existant";
                pseudoVerified = "nok";
            } else {
                messagePseudo.classList.remove("red-message");
                messagePseudo.textContent = "pseudo disponible";
                pseudoVerified = "ok";
            } 
        }); 
        ajaxPostPseudo.executer();
    });
    // Vérification email
    formInputEmail.addEventListener("input", function () {
        console.log("envois2");
        var dataSend = 'email='+ encodeURIComponent(formInputEmail.value);
        var ajaxPostEmail = Object.create(AjaxPost);
        
        var regexEmail = Object.create(Regex);
        regexEmail.init((/.+@.+\..+/), formInputEmail.value);
        
        if (regexEmail.verifier() === false && formInputEmail.value !== "") {
            messageEmail.classList.add("red-message");
            messageEmail.textContent = "email incorrect";  
        } else {
            ajaxPostEmail.init("index.php?action=verifEmailCreateAccount", dataSend, function(reponse) {
                console.log(dataSend);
                console.log(reponse);
                if (reponse === "existEmail") {
                    messageEmail.classList.add("red-message");
                    console.log("exist mail");
                    messageEmail.textContent = "email déjà existant";
                    emailVerified = "nok";
                } else {
                    messageEmail.classList.remove("red-message");
                    messageEmail.textContent = "email disponible";
                    emailVerified = "ok";
                }
            });   
            ajaxPostEmail.executer();
        }
    });
    // password
    formInputPass.addEventListener("input", function () {
        console.log("envois3");
        if (formInputVerifPass.value !== "") {
            formInputVerifPass.value = "";
            messageVerifPass.textContent = "";
            passVerified = "nok";
        }
    });
    // Vérification du password
    formInputVerifPass.addEventListener("input", function () {
    
        if (formInputPass.value === formInputVerifPass.value) {
            messageVerifPass.classList.remove("red-message");
            messageVerifPass.textContent = "mots de passe identique";
            passVerified = "ok";
            
        }else {
            messageVerifPass.classList.add("red-message");
            messageVerifPass.textContent = "mots de passe différents";
            passVerified = "nok";
        }
        if (formInputVerifPass.value === "") {
            messageVerifPass.textContent = "";
        }
    });

    formRegistration.addEventListener("submit", function (e) {    
        e.preventDefault();
   
        if (pseudoVerified === "ok" && emailVerified === "ok" && passVerified ==="ok"){
            formRegistration.submit();
        } else {
            console.log("nok");
        }
    })
}    
// Fin vérification infos création compte. Si le pseudo et le mail n'existe pas, le compte est créé

// Début connexion
// Début affichage de la fenêtre de connexion
var loginWindow = document.getElementById("login-window");
var opaqueWindow = document.getElementById("opaque-window");
// Depuis le menu
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

// Depuis la messagerie instantanée
var connectToMessage = document.getElementById("connect-to-message");

if (connectToMessage !== null) {
    
    connectToMessage.addEventListener("click", function() {
        loginWindow.style.display = "block";
        opaqueWindow.style.display = "block";
                
        opaqueWindow.addEventListener("click", function() {
            opaqueWindow.style.display = "none";
            loginWindow.style.display = "none";
        });
    }); 
}

// Depuis le forum
var connectToForum = document.getElementById("connect-to-forum");

if (connectToForum !== null) {
    
    connectToForum.addEventListener("click", function() {
        loginWindow.style.display = "block";
        opaqueWindow.style.display = "block";
                
        opaqueWindow.addEventListener("click", function() {
            opaqueWindow.style.display = "none";
            loginWindow.style.display = "none";
        });
    }); 
}

// Depuis le topic
var connectToReply = document.getElementById("connect-to-reply");

if (connectToReply !== null) {
   connectToReply.addEventListener("click", function() {
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
// Fin connexion

// Début page account
var displayFormAvatar = document.getElementById("form-avatar-window");

if (document.getElementById("account") !== null) {
    
    document.getElementById("btn-modify-avatar").addEventListener("click", function () {
        displayFormAvatar.style.display = "block";
        opaqueWindow.style.display = "block"
    
        opaqueWindow.addEventListener("click", function() {
            opaqueWindow.style.display = "none";
            displayFormAvatar.style.display = "none";
        });
        
        document.getElementById('close-avatar-window').addEventListener("click", function() {
            opaqueWindow.style.display = "none";
            displayFormAvatar.style.display = "none";
        });
    });
}
// Fin page account

// Début formulaire messagerie instantanée
// Event submit: envoi formulaire
var formAddMessage = document.getElementById('form-add-message');
var addMessage = document.getElementById('add-message');
var messageRequired = document.getElementById('message-required');

if (formAddMessage !== null) {

    formAddMessage.addEventListener("submit", function(e) {
        e.preventDefault();
        
         if (addMessage.value === "") {
            messageRequired.style.display = "block";
            addMessage.addEventListener("click", function () {
                messageRequired.style.display = "none";
            });
         } else {
            var dataSend = 'add-message='+ encodeURIComponent(addMessage.value);
            var ajaxPostMessage = Object.create(AjaxPost);

            ajaxPostMessage.init("index.php?action=addMessage", dataSend, function(reponse) {   
                document.getElementById('add-message').value ="";
            });
            ajaxPostMessage.executer();
        }
    });
}

// Ajaxpost pour récupérer les messages ajoutés
var allMessages = document.getElementById("all-messages");
var noneInstantMessage = document.getElementById("none-instant-message");
var firstMessageId;

if (formAddMessage !== null) {
    if (document.querySelector("#all-messages > div") == null) {
        noneInstantMessage.style.display = "block";
        firstMessageId = 0;
    }
    setInterval(function () {

        if (document.querySelector("#all-messages > div") !== null) {
            firstMessageId = document.querySelector("#all-messages > div").id;
        }

        var dataSend = 'idMessage='+ encodeURIComponent(firstMessageId);
        var ajaxPostGetMessage = Object.create(AjaxPost);
        
        ajaxPostGetMessage.init("index.php?action=verifUpdatedMessage", dataSend, function(reponse) {
            if (reponse) {
            allMessages.insertAdjacentHTML("afterbegin", reponse);
            noneInstantMessage.style.display = "none"    
            }
        });
        ajaxPostGetMessage.executer();
    }, 1000);
}
// Fin formulaire messagerie instantanée

// Début page createTopic
// vérification textarea "Ajouter le titre" et "Ajouter le contenu" avant de créer le nouveau topic
var formCreateTopic = document.getElementById("form-create-topic");
var noTitleTopic = document.getElementById("no-title-topic");
var noContentTopic = document.getElementById("no-content-topic");
var createTitleTopic = document.getElementById("create-title-topic");
var createContentTopic = document.getElementById("create-content-topic");

if (formCreateTopic !== null) {

    formCreateTopic.addEventListener("submit", function (e) {
        tinymce.triggerSave();
        e.preventDefault();
        
        var valueTitle = createTitleTopic.value;
        var valueContent = createContentTopic.value;
        
        if (valueTitle === "") {
            noTitleTopic.textContent = "Il faut ajouter un titre pour ajouter le billet"
            tinymce.get("create-title-topic").on("click", function () {
                noTitleTopic.textContent = "";
            });
        }
        if (valueContent === "") {
            noContentTopic.textContent = "Il faut ajouter le contenu pour ajouter le billet"
            tinymce.get("create-content-topic").on("click", function () {
                noContentTopic.textContent = "";
            });
        }
        if (valueTitle !== "" && valueContent !== "") {
            formCreateTopic.submit();
        }
    });
}
// Fin page createTopic

// Début page topic
// vérification textarea "Laisser un message" avant d'envoyer une réponse
var formReplyToMessage = document.getElementById("form-reply-to-message");
var noReplyToMessage = document.getElementById("no-reply-to-message");
var replyToMessage = document.getElementById("reply-to-message");
var noneMessagesTopic = document.getElementById("none-messages-topic");

if (formReplyToMessage !== null) {
    if (document.querySelector("#all-messages-topic > div") === null) {
        noneMessagesTopic.style.display = "block";
    }
    formReplyToMessage.addEventListener("submit", function (e) {
        tinymce.triggerSave();
        e.preventDefault();
        
        var valueReplyToMessage = replyToMessage.value;
        
        if (valueReplyToMessage === "") {
            noReplyToMessage.textContent = "Le champ est vide"
            tinymce.get("reply-to-message").on("click", function () {
                noReplyToMessage.textContent = "";
            });
        } else {
            var dataSend = 'reply-to-message='+ encodeURIComponent(valueReplyToMessage);
            var ajaxPostGetMessage = Object.create(AjaxPost);
            ajaxPostGetMessage.init(formReplyToMessage.getAttribute("action"), dataSend, function(reponse) {
                if (reponse) {
                tinymce.get('reply-to-message').setContent("");     document.getElementById("all-messages-topic").innerHTML = reponse;
                noneMessagesTopic.style.display = "none";
                }
            }); 
            ajaxPostGetMessage.executer();
        }
    });
}
// Fin page topic