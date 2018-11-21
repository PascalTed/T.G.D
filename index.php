<?php 

session_start();

require_once('controller/controller.php');

try {
    if (isset($_GET['action'])) {
        
        // Enregistrement du nouveau compte
        if ($_GET['action'] == 'createAccount') {
            if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])) {
                createAccount($_POST['pseudo'], $_POST['email'], $_POST['password']);
            } else {
                throw new Exception('Les informations (pseudo, email, password) n\'ont pas été envoyés.');
            }
            
        // Vérification des informations saisies (pseudo et pass), venant d'un ajaxpost, avant de se connecter
        } elseif ($_GET['action'] == 'connectAccount'){
            verifPseudoPass($_POST['pseudo-connect'], $_POST['password-connect']);
            
        // Déconnexion    
        } elseif ($_GET['action'] == 'logoutAccount') {
            if (isset($_SESSION['pseudo'])) {
                logoutAccount();
            } else {
                throw new Exception('Pas de session d\'enregistrée, il faut être connecté pour se déconnecté.'); 
            }
        }
    } else {
        demarrer();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

?>