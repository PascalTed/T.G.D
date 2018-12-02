<?php

// Chargement des classes
require_once('model/AccountManager.php');
require_once('model/MessageManager.php');

// Affiche la liste des billets
function demarrer()
{
    $messageManager = new MessageManager();
    $messages = $messageManager->getMessage();
    
    require_once('view/homeView.php');
}

// Affiche création d'un compte
function displayCreateAccount()
{
    require_once('view/registerAccountView.php');
}

// Vérification des informations saisies (pseudo et email), venant d'un ajaxpost, avant de créer un compte. 
function verifPseudo($pseudo) {

    $accountManager = new AccountManager();
    $accountManager->searchPseudo($pseudo);
}

function verifMail($mail) {

    $accountManager = new AccountManager();
    $accountManager->searchMail($mail);
}

// Création du compte
function createAccount($pseudo, $mail, $pass)
{    
    $accountManager = new AccountManager();
    $accountManager->editAccount($pseudo, $mail, $pass);
    
    header('Location: index.php');
}

// Modifier avatar
function modifyAvatar($imageAvatar, $userId)
{
    $accountManager = new AccountManager();
    $accountManager->changeAvatar($imageAvatar, $userId);
    
    require_once('view/accountView.php');
}

// Vérification des informations saisies (pseudo et pass), venant d'un ajaxpost, avant de se connecter
function verifPseudoPass($pseudo, $pass) 
{
    $accountManager = new AccountManager();
    $accountManager->searchPseudoPass($pseudo, $pass);
}

// Affiche mon compte
function displayAccount()
{
    require_once('view/accountView.php');
}

// se déconnecter
function logoutAccount()
{
    $accountManager = new AccountManager();
    $accountManager->removeSession();
    
    header('Location: index.php');  
}

// Ajouter un message
function addMessage($userId, $instantMessage)
{
    $messageManager = new MessageManager();
    $messageManager->editMessage($userId, $instantMessage);
}

// Vérifier si nouveaux messages ajoutés
function verifUpdatedMessage($messageId)
{
    $messageManager = new MessageManager();
    $messages = $messageManager->getLastMessage($messageId);
    
    while ($lastMessage = $messages->fetch()) {
?>

        <div id="<?= $lastMessage['id'] ?>" class="message">
            <img src="images/avatars/<?= $lastMessage['avatar'] ?>" id="mini-image-avatar" alt="mini image avatar"/> 
            <!-- Affichage de chaque message (toutes les données sont protégées par htmlspecialchars -->
            <p class="message-pseudo"><strong><?= htmlspecialchars($lastMessage['pseudo']) ?></strong></p>
            <p class="message-date"><em>le <?= $lastMessage['message_date_fr'] ?></em></p>
            <p>"<?= nl2br(htmlspecialchars($lastMessage['message'])) ?>"</p>
        </div>

<?php
    }
}

?>