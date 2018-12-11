<?php

// Chargement des classes
require_once('model/AccountManager.php');
require_once('model/MessageManager.php');
require_once('model/PostManager.php');

// Affiche la page d'accueil
function home()
{
    $messages = getAllmessages();
    
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

function getAllMessages()
{
    $messageManager = new MessageManager();
    $messages = $messageManager->getMessage();
    
    return $messages;
}

// Vérifier si nouveaux messages ajoutés
function verifUpdatedMessage($messageId)
{
    $messageManager = new MessageManager();
    $messages = $messageManager->getLastMessage($messageId);
    
    while ($lastMessage = $messages->fetch()) {
?>

        <div id="<?= $lastMessage['id'] ?>" class="message">
            <img src="images/avatars/<?= $lastMessage['avatar'] ?>" class="mini-image-avatar" alt="mini image avatar"/> 
            <!-- Affichage de chaque message (toutes les données sont protégées par htmlspecialchars -->
            <p class="message-pseudo"><strong><?= htmlspecialchars($lastMessage['pseudo']) ?></strong></p>
            <p class="message-date"><em>le <?= $lastMessage['message_date_fr'] ?></em></p>
            <p>"<?= nl2br(htmlspecialchars($lastMessage['message'])) ?>"</p>
        </div>

<?php
    }
}

// Afficher la page Nos jeux
function listGames()
{
    $postManager = new PostManager();
    $games = $postManager->getListGames();
    
    require_once('view/listGamesView.php');
}

// Afficher la page du jeu
function game($gameId)
{
    $postManager = new PostManager();
    $game = $postManager->getGame($gameId);
    
    require_once('view/GameView.php');
}

// Afficher la page des forums
function displayForums()
{
    $postManager = new PostManager();
    $forums = $postManager->getForums();
    
    require_once('view/forumsView.php');
}

// Afficher la page du forum et ses sujets
function displayForumTopics($forumId)
{
    $postManager = new PostManager();
    $topics = $postManager->getTopics($forumId);
    
    $forumIdCat = $postManager->getForumIdCat($forumId);
    
    require_once('view/forumTopicsView.php');
}

// Afficher la page du sujet et ses messages
function displayTopic($topicId)
{
    $postManager = new PostManager();
    $topicMessages = $postManager->getTopic($topicId);
    
    $forumTopics = $postManager->getForumTopics($topicId);
    
    require_once('view/topicView.php');
}

// Afficher la page créer un sujet
function displayCreateTopic($forumId)
{
    $postManager = new PostManager();
    $forumIdCat = $postManager->getForumIdCat($forumId);
    
    require_once('view/displayCreateTopicView.php');
}

// Enregistrement du nouveau sujet
function createTopic($forumId, $titleTopic, $contentTopic)
{
    $postManager = new PostManager();
    $postManager->editTopic($forumId, $titleTopic, $contentTopic);
    
    $forumIdCat = $postManager->getForumIdCat($forumId);
    
    require_once('view/forumTopicsView.php');
}

?>