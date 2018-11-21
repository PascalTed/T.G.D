<?php

// Chargement des classes
require_once('model/AccountManager.php');

// Affiche la liste des billets
function demarrer()
{
    require_once('view/instantMessagesView.php');
}

// Affiche création d'un compte
function displayCreateAccount()
{
    require_once('view/registerAccountView.php');
}

// Vérification des informations saisies (pseudo et email), venant d'un ajaxpost, avant de créer un compte. 
function verifPseudoMail($pseudo, $mail) {

    $accountManager = new AccountManager();
    $accountManager->searchPseudoMail($pseudo, $mail);
}

// Création du compte
function createAccount($pseudo, $mail, $pass)
{    
    $accountManager = new AccountManager();
    $accountManager->editAccount($pseudo, $mail, $pass);
    
    header('Location: index.php');
}

// Vérification des informations saisies (pseudo et pass), venant d'un ajaxpost, avant de se connecter
function verifPseudoPass($pseudo, $pass) 
{
    $accountManager = new AccountManager();
    $accountManager->searchPseudoPass($pseudo, $pass);
}

// se déconnecter
function logoutAccount()
{
    $accountManager = new AccountManager();
    $accountManager->removeSession();
    
    header('Location: index.php');  
}

?>