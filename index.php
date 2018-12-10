<?php 

session_start();

require_once('controller/controller.php');

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
        } elseif ($_GET['action'] == 'listPostsGames') {
            listPostsGames();
        } elseif ($_GET['action'] == 'postGame') {
            if (isset($_GET['idGame']) && $_GET['idGame'] > 0) {
                postGame($_GET['idGame']);
            } else {
                throw new Exception('Aucun id game envoyé.');
            }
        
        // Afficher la page des forums
        } elseif ($_GET['action'] == 'displayForums') {
            displayForums();
        
        // Afficher la page du forum et ses sujets
        } elseif ($_GET['action'] == 'displayForumTopics') {
            if (isset($_GET['idForum']) && $_GET['idForum'] > 0) {
                displayForumTopics($_GET['idForum']);
            } else {
                throw new Exception('Aucun id forum envoyé.');
            }
            
        // Afficher la page du sujet et ses messages   
        } elseif ($_GET['action'] == 'displayTopic') {
            if (isset($_GET['idTopic']) && $_GET['idTopic'] > 0) {
                displayTopic($_GET['idTopic']);
            } else {
                throw new Exception('Aucun id sujet envoyé.');
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