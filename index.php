<?php session_start();

require_once('controller/controller.php');

try {
    if (isset($_GET['action'])) {
        // Vérification des informations saisies (pseudo et pass), venant d'un ajaxpost, avant de se connecter
        if ($_GET['action'] == 'connectAccount'){
            verifPseudoPass($_POST['pseudo-connect'], $_POST['password-connect']);
        }
    } else {
        demarrer();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

?>