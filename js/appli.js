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

var pseudoVerified = "nok";
var emailVerified = "nok";
var passVerified = "nok";

if (formRegistration !== null) {
    
    formInputPseudo.value = "";
    formInputEmail.value = "";
    
    // Vérification pseudo
    formInputPseudo.addEventListener("input", function () {

        var dataSend = 'pseudo='+ encodeURIComponent(formInputPseudo.value);
        var ajaxPostPseudo = Object.create(AjaxPost);
        
        var regexPseudo = Object.create(Regex);
        regexPseudo.init((/\s+/), formInputPseudo.value);
        
        if (regexPseudo.verifier() === true) {

            messagePseudo.classList.add("red-message");
            messagePseudo.textContent = "pseudo incorrect (espace non accepté)";
            pseudoVerified = "nok";
        } else { 
            ajaxPostPseudo.init("index.php?action=verifPseudoCreateAccount", dataSend, function(reponse) {

                if (reponse === "existUser") {
                    messagePseudo.classList.add("red-message");
                    messagePseudo.textContent = "pseudo déjà existant";
                    pseudoVerified = "nok";
                } else {
                    if (formInputPseudo.value !== "") {
                        messagePseudo.classList.remove("red-message");
                        messagePseudo.textContent = "pseudo disponible";
                        pseudoVerified = "ok";
                    } else {
                        messagePseudo.textContent = "";
                        pseudoVerified = "nok";
                    }
                }
            }); 
            ajaxPostPseudo.executer();
        }
    });
    
    // Vérification email
    formInputEmail.addEventListener("input", function () {

        var dataSend = 'email='+ encodeURIComponent(formInputEmail.value);
        var ajaxPostEmail = Object.create(AjaxPost);
        
        var regexEmail = Object.create(Regex);
        regexEmail.init((/^\S+@\S+\.\S+$/), formInputEmail.value);
        
        if (formInputEmail.value === "") {
            messageEmail.textContent = "";
        } else {
            if (regexEmail.verifier() === false) {
                messageEmail.classList.add("orange-message");
                messageEmail.textContent = "format email incorrect";
                emailVerified = "nok";
            } else {
                ajaxPostEmail.init("index.php?action=verifEmailCreateAccount", dataSend, function(reponse) {

                    if (reponse === "existEmail") {
                        messageEmail.classList.remove("orange-message");
                        messageEmail.classList.add("red-message");
                        messageEmail.textContent = "email déjà existant";
                        emailVerified = "nok";
                    } else {
                        messageEmail.classList.remove("orange-message");
                        messageEmail.classList.remove("red-message");
                        messageEmail.textContent = "email disponible";
                        emailVerified = "ok";
                    }
                });   
                ajaxPostEmail.executer();
            }
        }
    });
    // password
    formInputPass.addEventListener("input", function () {

        if (formInputVerifPass.value !== "") {
            formInputVerifPass.value = "";
            messageVerifPass.textContent = "";
            passVerified = "nok";
        }
    });
    // Vérification du password
    formInputVerifPass.addEventListener("input", function () {
    
        if (formInputPass.value === formInputVerifPass.value) {
            if (formInputVerifPass.value !== "") {
                messageVerifPass.classList.remove("red-message");
                messageVerifPass.textContent = "mots de passe identique";
                passVerified = "ok";
            } else {
                messageVerifPass.textContent = "";
                passVerified = "nok";
            }
        } else {
            messageVerifPass.classList.add("red-message");
            messageVerifPass.textContent = "mots de passe différents";
            passVerified = "nok";
        }
    });

    formRegistration.addEventListener("submit", function (e) {    
        e.preventDefault();
   
        if (pseudoVerified === "ok" && emailVerified === "ok" && passVerified ==="ok"){
            formRegistration.submit();
        }
    })
}    
// Fin vérification infos création compte. Si le pseudo et le mail n'existe pas, le compte est créé

// Début connexion
// Début affichage de la fenêtre de connexion
var loginWindow = document.getElementById("login-window");
var opaqueWindow = document.getElementById("opaque-window");
var pseudoPassAlert = document.getElementById("pseudo-pass-alert");

// Depuis le menu
var menuConnect = document.getElementById("header-menu-connect");

if (menuConnect !== null) {
    
    menuConnect.addEventListener("click", function() {
        loginWindow.style.display = "block";
        opaqueWindow.style.display = "block";
        if (pseudoPassAlert.style.display === "block") {
            pseudoPassAlert.style.display = "none";
        }
                
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
        if (pseudoPassAlert.style.display === "block") {
            pseudoPassAlert.style.display = "none";
        }
        opaqueWindow.addEventListener("click", function() {
            opaqueWindow.style.display = "none";
            loginWindow.style.display = "none";
        });
    }); 
}

// Depuis le forum
var connectAddTopic = document.getElementById("connect-add-topic");

if (connectAddTopic !== null) {
    
    connectAddTopic.addEventListener("click", function() {
        loginWindow.style.display = "block";
        opaqueWindow.style.display = "block";
        if (pseudoPassAlert.style.display === "block") {
            pseudoPassAlert.style.display = "none";
        }
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
       if (pseudoPassAlert.style.display === "block") {
            pseudoPassAlert.style.display = "none";
       }
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
            pseudoPassAlert.style.display = "block";
                        
            document.getElementById("pseudo-connect").addEventListener("click", function () {
                pseudoPassAlert.style.display = "none";
            });
            document.getElementById("password-connect").addEventListener("click", function () {
                pseudoPassAlert.style.display = "none";
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
var formAvatar = document.getElementById("form-avatar");
var maxFileAvatar = document.getElementById("max-file-avatar");
var fileAvatar = document.getElementById("file-avatar");
var incorrectFileAvatar = document.getElementById("incorrect-file-avatar");

if (formAvatar !== null) {
    
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
    
    formAvatar.addEventListener("submit", function (e) {
        e.preventDefault();
        
        var regexExtensionImage = Object.create(Regex);
        regexExtensionImage.init((/\.(gif|jpg|jpeg|png)$/i), fileAvatar.files[0].name);
        var sizeFileAvatar = fileAvatar.files[0].size;
        
        if (sizeFileAvatar > 1048576) {
            maxFileAvatar.style.display = "block";
            fileAvatar.addEventListener("click", function () {
                maxFileAvatar.style.display = "none";
            });
        } else if (!regexExtensionImage.verifier()) {
            incorrectFileAvatar.style.display = "block";
            fileAvatar.addEventListener("click", function () {
                incorrectFileAvatar.style.display = "none";
            });
        } else {
        
            formAvatar.submit();
        }
    })
}
// Fin page account

// Début formulaire messagerie instantanée
// Event submit: envoi formulaire
var formAddMessage = document.getElementById('form-add-message');
var addMessage = document.getElementById('add-message');
var messageRequired = document.getElementById('message-required');

var allMessages = document.getElementById("all-messages");
var noneInstantMessage = document.getElementById("none-instant-message");
var firstMessageId;

if (document.getElementById("instant-messages") !== null) {
    if (document.querySelector("#all-messages > div") === null) {
        noneInstantMessage.style.display = "block";
        firstMessageId = 0;
    }
    // Ajaxpost pour récupérer les messages ajoutés toute les 1 secondes
    setInterval(function () {

        if (document.querySelector("#all-messages > div") !== null) {
            firstMessageId = document.querySelector("#all-messages > div").id;
            // Supprimer "message" de firstMessageId, on récupère juste le numéro du message 
            var regexIdMessage = "message-";
            firstMessageId = firstMessageId.replace(regexIdMessage, '');
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
// Fin formulaire messagerie instantanée

// Début page createTopic
// vérification textarea "Ajouter le titre" et "Ajouter le contenu" avant de créer le nouveau topic
var topicExist = document.getElementById("topic-exist");
var createTitleTopic = document.getElementById("create-title-topic");
var createContentTopic = document.getElementById("create-content-topic");
var noTitleTopic = document.getElementById("no-title-topic");
var noContentTopic = document.getElementById("no-content-topic");
var formCreateTopic = document.getElementById("form-create-topic");

if (formCreateTopic !== null) {

    formCreateTopic.addEventListener("submit", function (e) {
        tinymce.triggerSave();
        e.preventDefault();
        
        var valueTitle = createTitleTopic.value;
        var valueContent = createContentTopic.value;
        
        if (valueTitle === "") {
            noTitleTopic.style.display = "block";
            createTitleTopic.addEventListener("click", function () {
                noTitleTopic.style.display = "none";
            });
        }
        if (valueContent === "") {
            noContentTopic.style.display = "block";
            tinymce.get("create-content-topic").on("click", function () {
                noContentTopic.style.display = "none";
            });
        }
        if (valueTitle !== "" && valueContent !== "") {
        
            var dataSend = 'topicTitle='+ encodeURIComponent(createTitleTopic.value);
            var ajaxPostVerifyTopic = Object.create(AjaxPost);

            ajaxPostVerifyTopic.init("index.php?action=verifyTopic", dataSend, function(reponse) {

                if (reponse === "existTopic") {
                    topicExist.style.display = "block";
                    createTitleTopic.addEventListener("click", function () {
                        topicExist.style.display = "none";
                    });
                } else {
                    formCreateTopic.submit();
                }
            });
            ajaxPostVerifyTopic.executer();
        }
    });
}
// Fin page createTopic

// Début page topic
// vérification textarea "Laisser un message" avant d'envoyer une réponse
var formReplyToMessage = document.getElementById("form-reply-to-message");
var noReplyToMessage = document.getElementById("no-reply-to-message");
var replyToMessage = document.getElementById("reply-to-message");

var topicContent = document.getElementById("topic-content");

if (formReplyToMessage !== null) {

    formReplyToMessage.addEventListener("submit", function (e) {
        tinymce.triggerSave();
        e.preventDefault();
        
        var valueReplyToMessage = replyToMessage.value;
        
        if (valueReplyToMessage === "") {
            noReplyToMessage.style.display = "block"
            tinymce.get("reply-to-message").on("click", function () {
                noReplyToMessage.style.display = "none"
            });
        } else {
            var dataSend = 'reply-to-message='+ encodeURIComponent(valueReplyToMessage);
            var ajaxPostGetMessage = Object.create(AjaxPost);
            ajaxPostGetMessage.init(formReplyToMessage.getAttribute("action"), dataSend, function(reponse) {
                if (reponse) {
                tinymce.get('reply-to-message').setContent("");
                topicContent.innerHTML = reponse;
                }
            }); 
            ajaxPostGetMessage.executer();
        }
    });
}

// Ajaxpost pour signaler un message et récupérer les messages
if (topicContent !== null) {
    topicContent.addEventListener("click", function (e) {
        if (e.target.className == "to-report") {
            e.preventDefault();
            var ajaxGetToReportMessage = Object.create(AjaxGet);
            ajaxGetToReportMessage.init(e.target.getAttribute("href"), function(reponse) {
                topicContent.innerHTML = reponse;
            });
            ajaxGetToReportMessage.executer();
        } 
    });
}
// Fin page topic

// Début page forums (administration)
// vérification si textarea vide
// Ajaxpost pour vérifier si une catégorie forum est déjà existante avant sa création
var addForum = document.getElementById("add-forum");
var formAddForum = document.getElementById("form-add-forum");
var addForumExist = document.getElementById("add-forum-exist");
var addForumEmpty = document.getElementById("add-forum-empty");

if (formAddForum !== null) {
    formAddForum.addEventListener("submit", function (e) {
        tinymce.triggerSave();
        e.preventDefault();
        
        var dataSend = 'catForum='+ encodeURIComponent(addForum.value);
        var ajaxPostVerifyForum = Object.create(AjaxPost);
        var valueAddForum = addForum.value;
        
        if (valueAddForum !== "") {
            ajaxPostVerifyForum.init("index.php?action=verifyForum", dataSend, function(reponse) { 
                if (reponse === "existForum") {
                    addForumExist.style.display = "block";
                    addForum.addEventListener("click", function () {
                        addForumExist.style.display = "none";
                    });
                } else {
                    formAddForum.submit();
                }
            });
            ajaxPostVerifyForum.executer();
        } else {
            addForumEmpty.style.display ="block";
            addForum.addEventListener("click", function () {
                addForumEmpty.style.display ="none";
            });
        }
    });
}
// Fin page forums (administration)

// Début page forumTopics (administration)
// Ajaxpost pour vérifier si une catégorie forum est déjà existante avant la modification d'un forum. Pour une suppression il n'y a pas de vérification
var textareaCatForum = document.getElementById("textarea-cat-forum");
var admModifyForum = document.getElementById("adm-modify-forum");
var noForum = document.getElementById("no-forum");
var formEditForum = document.getElementById("form-edit-forum");
var forumExist = document.getElementById("forum-exist");

if (formEditForum !== null) {
    formEditForum.addEventListener("submit", function (e) {
        tinymce.triggerSave();
        e.preventDefault();
        
        if (admModifyForum.checked) {
            if (textareaCatForum.value !== "") {
                var dataSend = 'catForum='+ encodeURIComponent(textareaCatForum.value);
                var ajaxPostVerifyForum = Object.create(AjaxPost);

                ajaxPostVerifyForum.init("index.php?action=verifyForum", dataSend, function(reponse) { 
                    if (reponse === "existForum") {
                        forumExist.style.display = "block";
                        textareaCatForum.addEventListener("click", function (e) {
                            forumExist.style.display = "none";
                        });
                    } else {
                        formEditForum.submit();
                    }
                });
                ajaxPostVerifyForum.executer();
            } else {
                noForum.style.display = "block";
                textareaCatForum.addEventListener("click", function () {
                    noForum.style.display = "none";
                });
            }
        } else {
            formEditForum.submit();
        }
    });
}
// Fin page forumTopics (administration)

// Début page Topic (administration)
var textareaEditTopic = document.getElementById("textarea-edit-topic");
var admModifyTopic = document.getElementById("adm-modify-topic");
var noTopic = document.getElementById("no-topic");
var topicExist = document.getElementById("topic-exist");
var formEditTopic = document.getElementById("form-edit-topic");

if (formEditTopic !== null) {
    formEditTopic.addEventListener("submit", function (e) {
        
        tinymce.triggerSave();
        e.preventDefault();
        if (admModifyTopic.checked) {
            if (textareaEditTopic.value !== "") {
                var dataSend = 'topicTitle='+ encodeURIComponent(textareaEditTopic.value);
                var ajaxPostVerifyTopic = Object.create(AjaxPost);

                ajaxPostVerifyTopic.init("index.php?action=verifyTopic", dataSend, function(reponse) { 
                    if (reponse === "existTopic") {
                        topicExist.style.display = "block";
                        textareaEditTopic.addEventListener("click", function (e) {
                            topicExist.style.display = "none";
                        });
                    } else {
                        formEditTopic.submit();
                    }
                });
                ajaxPostVerifyTopic.executer();
            } else {
                noTopic.style.display = "block";
                textareaEditTopic.addEventListener("click", function () {
                    noTopic.style.display = "none";
                });
            }
        } else {
            formEditTopic.submit();
        }
    });
}
// Fin page Topic (administration)

// Début page createGame (administration)
var formCreateGame = document.getElementById("form-create-game");

var titleGame = document.getElementById("title-game");
var noTitleGame = document.getElementById("no-title-game");

var releaseDateGame = document.getElementById("release-date-game");
var noDateGame = document.getElementById("no-date-game");

var typeGame = document.getElementById("type-game");
var noTypeGame = document.getElementById("no-type-game");

var fileGame = document.getElementById('file-game');
var maxFileGame = document.getElementById("max-file-game");

var contentGame = document.getElementById("content-game");
var noContentGame = document.getElementById("no-content-game");

if (formCreateGame !== null) {
    formCreateGame.addEventListener("submit", function(e) {
        tinymce.triggerSave();
        e.preventDefault();
        
        var valueTitleGame = titleGame.value;
        var valueReleaseDateGame = releaseDateGame.value;
        var valueTypeGame = typeGame.value;
        var valueContentGame = contentGame.value;
        
        var sizeFileGame = fileGame.files[0].size;
        
        
        if (valueTitleGame == "") {
            noTitleGame.style.display = "block";
            titleGame.addEventListener("click", function () {
                noTitleGame.style.display = "none";
            });
        }
        if (valueReleaseDateGame == "") {
            noDateGame.style.display = "block";
            releaseDateGame.addEventListener("click", function () {
                noDateGame.style.display = "none";
            });
        }
        if (valueTypeGame == "") {
            noTypeGame.style.display = "block";
            typeGame.addEventListener("click", function () {
                noTypeGame.style.display = "none";
            });
        }
        if (sizeFileGame > 2097152) {
            maxFileGame.style.display = "block";
            fileGame.addEventListener("click", function () {
                maxFileGame.style.display = "none";
            });
        }
        if (valueContentGame == "") {
            noContentGame.style.display = "block";
            tinymce.get("content-game").on("click", function () {
                noContentGame.style.display = "none";
            });
        }
        if (valueTitleGame !== "" && valueReleaseDateGame !== "" && valueTypeGame !== "" && sizeFileGame <= 2097152 && valueContentGame !== "") {
            formCreateGame.submit();
        }
        
    });
}
// Fin page createGame (administration)

// Début page modifyGame (administration)
var formEditGame = document.getElementById("form-edit-game");

var editTitleGame = document.getElementById("edit-title-game");
var noEditTitleGame = document.getElementById("no-edit-title-game");

var editDateGame = document.getElementById("edit-date-game");
var noEditDateGame = document.getElementById("no-edit-date-game");

var editTypeGame = document.getElementById("edit-type-game");
var noEditTypeGame = document.getElementById("no-edit-type-game");

var editFileGame = document.getElementById('edit-file-game');
var maxEditFileGame = document.getElementById("max-edit-file-game");
var existEditFileGame = document.getElementById("exist-edit-file-game");

var editContentGame = document.getElementById("edit-content-game");
var noEditContentGame = document.getElementById("no-edit-content-game");

if (formEditGame !== null) {
    formEditGame.addEventListener("submit", function(e) {
        tinymce.triggerSave();
        e.preventDefault();

        var admModifyGame = document.getElementById("adm-modify-game");
        var valueEditTitleGame = editTitleGame.value;
        var valueEditDateGame = editDateGame.value;
        var valueEditTypeGame = editTypeGame.value;
        var valueEditContentGame = editContentGame.value;
        
        if(admModifyGame.checked) {

            if (valueEditTitleGame == "") {
                noEditTitleGame.style.display = "block";
                editTitleGame.addEventListener("click", function () {
                    noEditTitleGame.style.display = "none";
                });
            }
            if (valueEditDateGame == "") {
                noEditDateGame.style.display = "block";
                editDateGame.addEventListener("click", function () {
                    noEditDateGame.style.display = "none";
                });
            }
            if (valueEditTypeGame == "") {
                noEditTypeGame.style.display = "block";
                editTypeGame.addEventListener("click", function () {
                    noEditTypeGame.style.display = "none";
                });
            }
            if (editFileGame.files.length > 0) {
                var sizeFileEditGame = editFileGame.files[0].size;
                if (sizeFileEditGame > 2097152) {
                    maxEditFileGame.style.display = "block";
                    editFileGame.addEventListener("click", function () {
                        maxEditFileGame.style.display = "none";
                    });
                }
            } else {
                existEditFileGame.style.display = "block";
                editFileGame.addEventListener("click", function () {
                    existEditFileGame.style.display = "none";
                });
            }
            if (valueEditContentGame == "") {
                noEditContentGame.style.display = "block";
                tinymce.get("edit-content-game").on("click", function () {
                    noEditContentGame.style.display = "none";
                });
            }
            if (valueEditTitleGame !== "" && valueEditDateGame !== "" && valueEditTypeGame !== "" && sizeFileEditGame <= 2097152 && valueEditContentGame !== "") {
                formEditGame.submit();
            }
        } else {
            formEditGame.submit();
        }
    });
}
// Fin page modifyGame (administration)