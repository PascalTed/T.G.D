<?php 

session_start();

require_once('controller/frontend.php');
require_once('controller/backend.php');

try {
    if (isset($_GET['action'])) {
        
        // Afficher la page pour créer un compte
        if ($_GET['action'] == 'displayCreateAccount') {
            displayCreateAccount();
            
        // Vérification des informations saisies (pseudo et email), venant d'un ajaxpost, avant de créer un compte.   
        } elseif ($_GET['action'] == 'verifPseudoCreateAccount') {
            if (isset($_POST['pseudo'])) {
                verifPseudo($_POST['pseudo']);
            } else {
                throw new Exception('Aucun pseudo envoyé.'); 
            }
        } elseif ($_GET['action'] == 'verifEmailCreateAccount') {
            if (isset ($_POST['email'])) {
                verifMail($_POST['email']);
            } else {
                throw new Exception('Aucun email envoyé.');
            }
        // Enregistrement du nouveau compte
        } elseif ($_GET['action'] == 'createAccount') {
            if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])) {
                createAccount($_POST['pseudo'], $_POST['email'], $_POST['password']);
            } else {
                throw new Exception('Les informations (pseudo, email, password) n\'ont pas été envoyés.');
            }
            
        // Vérification des informations saisies (pseudo et pass), venant d'un ajaxpost, avant de se connecter
        } elseif ($_GET['action'] == 'connectAccount'){
            if (isset($_POST['pseudo-connect']) && isset($_POST['password-connect'])) {
                verifPseudoPass($_POST['pseudo-connect'], $_POST['password-connect']);
            } else {
                throw new Exception('Les informations (pseudo, email) n\'ont pas été envoyés.');
            }
        
        // Afficher la page Mon compte
        } elseif ($_GET['action'] == 'displayAccount') {
            if (isset($_SESSION['pseudo'])) {
                displayAccount();
            } else {
                throw new Exception('Il faut être connecté pour accéder à son compte, pas de session pseudo enregistré.');
            }
        
        // envoie de l'image avatar
        } elseif ($_GET['action'] == 'modifyAvatar') {
            if (isset($_SESSION['pseudo'])) {
                if (isset($_FILES['file-avatar']) && $_FILES['file-avatar']['error'] == 0) {
                    if ($_FILES['file-avatar']['size'] <= 1048576) {
                        modifyAvatar($_FILES['file-avatar'], $_SESSION['id']);
                    } else {
                        throw new Exception('fichier trop gros.');
                    }
                } else {
                    throw new Exception('Aucun fichier envoyé ou erreur lors de l\'envoi.');
                } 
            } else {
                throw new Exception('Aucun pseudo envoyé.'); 
            }
            
        // Déconnexion    
        } elseif ($_GET['action'] == 'logoutAccount') {
            if (isset($_SESSION['pseudo'])) {
                logoutAccount();
            } else {
                throw new Exception('Pas de session d\'enregistrée, il faut être connecté pour se déconnecter.'); 
            }
            
        // Ajouter un message, Venant d'un ajaxpost.
        } elseif ($_GET['action'] == 'addMessage') {
            if (isset($_SESSION['pseudo'])) {
                if (isset($_POST['add-message'])) {
                    addMessage($_SESSION['id'], $_POST['add-message']);
                } else {
                    throw new Exception('Aucun message envoyé');
                }
            } else {
                throw new Exception('Aucun pseudo envoyé.');
            }
            
        // Vérifier si nouveaux messages ajoutés, Venant d'un ajaxpost.  
        } elseif ($_GET['action'] == 'verifUpdatedMessage') {
            if (isset($_SESSION['pseudo'])) {
                if (isset($_POST['idMessage']) && $_POST['idMessage'] >= 0) {
                    verifUpdatedMessage($_POST['idMessage']);
                } else {
                    throw new Exception('Aucun id message envoyé.');
                }
            } else {
                throw new Exception('Aucun pseudo envoyé.');
            }
            
        // Afficher la page Nos jeux
        } elseif ($_GET['action'] == 'displayListGames') {
            displayListGames();
        } elseif ($_GET['action'] == 'displayGame') {
            if (isset($_GET['idGame']) && $_GET['idGame'] > 0) {
                displayGame($_GET['idGame']);
            } else {
                throw new Exception('Aucun id game envoyé.');
            }
        
        // Afficher la page des forums
        } elseif ($_GET['action'] == 'displayForums') {
            displayForums();
        
        // Afficher la page du forum et ses sujets
        } elseif ($_GET['action'] == 'displayForumTopics') {
            if ((isset($_GET['idForum']) AND $_GET['idForum'] > 0) AND isset($_GET['catForum'])) {
                displayForumTopics($_GET['idForum'], $_GET['catForum']);
            } else {
                throw new Exception('Aucun id ou catégorie forum envoyé.');
            }
            
        // Afficher la page du sujet et ses messages   
        } elseif ($_GET['action'] == 'displayTopic') {
            if (isset($_GET['idForum']) && $_GET['idForum'] > 0 && isset($_GET['catForum']) && isset($_GET['idTopic']) && $_GET['idTopic'] > 0) {
                displayTopic($_GET['idForum'], $_GET['catForum'], $_GET['idTopic']);
            } else {
                throw new Exception('Aucun id sujet ou id forum ou catégorie forum envoyé.');
            }
            
        // Afficher page pour créer un sujet
        } elseif ($_GET['action'] == 'displayCreateTopic') {
            if (isset($_SESSION['pseudo'])) {
                if ((isset($_GET['idForum']) AND $_GET['idForum'] > 0) AND isset($_GET['catForum'])) {
                    displayCreateTopic($_GET['idForum'], $_GET['catForum']);
                } else {
                    throw new Exception('Aucun id ou catégorie forum envoyé.');
                }
            } else {
                throw new Exception('Aucun pseudo envoyé.');
            }
        
        // Enregistrement du nouveau sujet    
        }elseif ($_GET['action'] == 'createTopic') {
            if (isset($_SESSION['pseudo'])) {
                if ((isset($_GET['idForum']) AND $_GET['idForum'] > 0) AND isset($_GET['catForum'])) {
                    if (isset($_POST['create-title-topic']) && isset($_POST['create-content-topic'])) {
                        createTopic($_SESSION['id'], $_GET['idForum'], $_GET['catForum'], $_POST['create-title-topic'], $_POST['create-content-topic']);
                    } else {
                        throw new Exception('Aucun titre ou contenu du nouveau sujet envoyés.');
                    }
                } else {
                    throw new Exception('Aucun id ou catégorie forum envoyé.');
                }
            } else {
                throw new Exception('Aucun pseudo envoyé.');
            }

        // Enregistrement d'un message réponse depuis un topic venant d'un ajaxpost   
        } elseif ($_GET['action'] == 'replyToMessage') {
            if (isset($_SESSION['pseudo'])) {
                if (isset($_GET['idForum']) && $_GET['idForum'] > 0 && isset($_GET['idTopic']) && $_GET['idTopic'] > 0) {
                    if (isset($_POST['reply-to-message'])) {
                        replyToMessage($_SESSION['id'], $_POST['reply-to-message'], $_GET['idForum'], $_GET['idTopic']);
                    } else {
                        throw new Exception('Aucune réponse envoyée.');
                    }
                } else {
                    throw new Exception('Aucun id forum ou topic envoyé.');
                } 
            } else {
                throw new Exception('Aucun pseudo envoyé.');
            }
            
        // Signaler un message d'un topic    
        } elseif ($_GET['action'] == 'reportTopicMessage') {
            if (isset($_SESSION['pseudo'])) {
                if (isset($_GET['idMessage']) && isset($_GET['idTopic'])) {
                    reportTopicMessage($_GET['idMessage'], $_GET['idTopic']);
                } else {
                    throw new Exception('Aucun id message ou topic envoyé.');
                }
            } else {
                throw new Exception('Aucun pseudo envoyé.');
            }
        
        // Afficher la page accueil (administration)
        } elseif ($_GET['action'] == 'displayAdminHome') {
            if (isset($_SESSION['user_right']) && $_SESSION['user_right'] == "admin") {
                displayAdminHome();
            } else {
                throw new Exception('Aucun droit envoyé.');
            }
            
        // Afficher la page forums (administration)
        } elseif ($_GET['action'] == 'displayAdminForums') {
            if (isset($_SESSION['user_right']) && $_SESSION['user_right'] == "admin") {
                displayAdminForums();
            } else {
                throw new Exception('Aucun droit envoyé.');
            }
         
        // Ajouter une nouvelle catégorie forum (administration)
        } elseif ($_GET['action'] == 'addForumCat') {
            if (isset($_SESSION['user_right']) && $_SESSION['user_right'] == "admin") {
                if (isset($_POST['add-forum'])) {
                    addForumCat($_SESSION['id'], $_POST['add-forum']);
                } else {
                    throw new Exception('Aucune nouvelle catégorie de forum envoyée.');
                }
            } else {
                throw new Exception('Aucun droit envoyé.');
            }
        
        // Modifier ou supprimer une catégorie forum (administration)
        } elseif ($_GET['action'] == 'modifyOrRemoveForum') {
            if (isset($_SESSION['user_right']) && $_SESSION['user_right'] == "admin") {
                if (isset($_POST['setForum'])) {
                    switch ($_POST['setForum']) {
                        case 'adm-modify-forum':
                            modifyForumCat($_SESSION['id'], $_POST['textarea-cat-forum'], $_GET['idForum']);
                            break;
                        case 'adm-remove-forum':
                            removeForumCat($_GET['idForum']);
                            break;
                        default: 'ce choix n\'existe pas';
                    }
                } else {
                    throw new Exception('le choix modifier ou supprimer un forum n\'a pas été envoyé');
                }
            } else {
                throw new Exception('Aucun droit envoyé.');
            }
        
        // Vérifier si la catégorie d'un forum existe déjà avant la modification ou la création de celui-ci, Venant d'un ajaxpost (administration)
        } elseif ($_GET['action'] == 'verifyForum') {
            if (isset($_SESSION['user_right']) && $_SESSION['user_right'] == "admin") {
                if (isset($_POST['catForum'])) {
                        verifyForum($_POST['catForum']);
                } else {
                    throw new Exception('Aucune catégorie forum envoyée.');
                }
            } else {
                throw new Exception('Aucun droit envoyé.');
            }
            
        // Afficher la page du forum et ses sujets (administration)
        } elseif ($_GET['action'] == 'displayAdminForumTopics') {
            if (isset($_SESSION['user_right']) && $_SESSION['user_right'] == "admin") {
                if (isset($_GET['idForum']) AND $_GET['idForum'] > 0 AND isset($_GET['catForum'])) {
                    displayAdminForumTopics($_GET['idForum'], $_GET['catForum']);
                } else {
                    throw new Exception('Aucun id ou catégorie forum envoyé.');
                }
            } else {
                throw new Exception('Aucun droit envoyé.');
            }
        // Afficher la page du sujet et ses messages (administration)
        } elseif ($_GET['action'] == 'displayAdminTopic'){
            if (isset($_SESSION['user_right']) && $_SESSION['user_right'] == "admin") {
                if (isset($_GET['idForum']) && $_GET['idForum'] > 0 && isset($_GET['catForum']) && isset($_GET['idTopic']) && $_GET['idTopic'] > 0) {
                displayAdminTopic($_GET['idForum'], $_GET['catForum'], $_GET['idTopic']);
                } else {
                throw new Exception('Aucun id sujet ou id forum ou catégorie forum envoyé.');
                }
            } else {
                throw new Exception('Aucun droit envoyé.');
            }
            
        // Modifier ou supprimer un topic (administration)
        } elseif ($_GET['action'] == 'modifyOrRemoveTopic') {
            if (isset($_SESSION['user_right']) && $_SESSION['user_right'] == "admin") {
                if (isset($_POST['setTopic'])) {
                    switch ($_POST['setTopic']) {
                        case 'adm-modify-topic':
                            modifyTopic($_SESSION['id'], $_POST['textarea-edit-topic'], $_GET['idTopic']);
                            break;
                        case 'adm-remove-topic':
                            removeTopic($_GET['idTopic']);
                            break;
                        default: 'ce choix n\'existe pas';
                    }
                } else {
                    throw new Exception('le choix modifier ou supprimer un topic n\'a pas été envoyé');
                }
            } else {
                throw new Exception('Aucun droit envoyé.');
            }
        }
    } else {
        home();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

?>