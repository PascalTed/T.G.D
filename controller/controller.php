<?php

// Chargement des classes
require_once('model/AccountManage.php');

// Affiche la liste des billets
function demarrer()
{
    require_once('view/instantMessagesView.php');
}

// Vérification des informations saisies (pseudo et pass), venant d'un ajaxpost, avant de se connecter
function verifPseudoPass($pseudo, $pass) 
{
    $accountManager = new AccountManager();
    $accountManager->searchPseudoPass($pseudo, $pass);
}

?>