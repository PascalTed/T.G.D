<?php

// Chargement des classes
require_once('model/AccountManager.php');
require_once('model/InstantMessageManager.php');
require_once('model/GameManager.php');
require_once('model/ForumManager.php');
require_once('model/AdminForumManager.php');

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
    
    header('Location: index.php?action=displayAccount');
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
    $instantMessageManager = new InstantMessageManager();
    $instantMessageManager->editMessage($userId, $instantMessage);
}

function getAllMessages()
{
    $instantMessageManager = new InstantMessageManager();
    $messages = $instantMessageManager->getMessage();
    
    return $messages;
}

// Vérifier si nouveaux messages ajoutés
function verifUpdatedMessage($messageId)
{
    $instantMessageManager = new InstantMessageManager();
    $messages = $instantMessageManager->getLastMessage($messageId);
    
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
function displayListGames()
{
    $gameManager = new GameManager();
    $games = $gameManager->getListGames();
    
    require_once('view/listGamesView.php');
}

// Afficher la page du jeu
function displayGame($gameId)
{
    $gameManager = new GameManager();
    $game = $gameManager->getGame($gameId);
    
    require_once('view/GameView.php');
}

// Afficher la page des forums
function displayForums()
{
    $forumManager = new ForumManager();
    $forums = $forumManager->getForums();
    
    require_once('view/forumsView.php');
}

// Afficher la page du forum et ses sujets
function displayForumTopics($forumId, $forumCat)
{
    $forumManager = new ForumManager();
    $topics = $forumManager->getTopics($forumId);
    
    require_once('view/forumTopicsView.php');
}

// Afficher la page du sujet et ses messages
function displayTopicMessages($forumId, $forumCat, $topicId)
{
    $forumManager = new ForumManager();
    $topicMessages = $forumManager->getTopicMessages($topicId);
    
    $infoTopic = $forumManager->getInfoTopic($topicId);
    
    require_once('view/topicView.php');
}

// Afficher la page créer un sujet
function displayCreateTopic($forumId, $forumCat)
{
    require_once('view/createTopicView.php');
}

// Enregistrement du nouveau sujet
function createTopic($userId, $forumId, $forumCat, $titleTopic, $firstMessageTopic)
{
    $forumManager = new ForumManager();
    $forumManager->editTopic($userId, $forumId, $titleTopic, $firstMessageTopic);
    
    header('Location: index.php?action=displayForumTopics&idForum=' . $forumId . '&catForum=' . $forumCat);
}

// Enregistrer message réponse d'un topic
function replyToMessage($userId, $message, $forumId, $topicId)
{
    $forumManager = new ForumManager();
    $forumManager->editMessage($userId, $message, $forumId, $topicId);
    
    $actualizeMessages = updateMessages($topicId);
    echo $actualizeMessages;
}

// Mettre à jour la liste des messages d'un topic
function updateMessages($topicId)    
{
    $forumManager = new ForumManager();
    $topicMessages = $forumManager->getTopicMessages($topicId);
    
    while ($topic = $topicMessages->fetch()) {
    ?>

        <div><p>posté par <?= $topic['pseudo'] ?></p></div>
        <div>message  <?= $topic['message'] ?></div>
        <div>Date du message : <?= $topic['message_date'] ?></div>  

        <?php
        if (isset($_SESSION['pseudo'])) {
            if ($topic['moderation'] == 1) {
            ?>
                <p class="already-report">Message signalé</p>
                <?php
            } else {
            ?>
                <p><a  class="to-report" href="index.php?action=reportTopicMessage&amp;idMessage=<?= $topic['tm_id']; ?>&amp;idTopic=<?= $topicId; ?> ">Signaler</a></p>
    <?php
            }
        }
    }
}

// Signaler un message d'un topic
function reportTopicMessage($messageId, $topicId)
{
    $forumManager = new ForumManager();
    $forumManager->editReport($messageId);
    
    $actualizeMessages = updateMessages($topicId);
    echo $actualizeMessages;
}

// Afficher la page accueil (administration)
function displayAdminHome()
{
    $messages = getAllmessages();
    require_once('view/adminHomeView.php');
}

// Afficher la page forums (administration)
function displayAdminForums()
{
    $forumManager = new ForumManager();
    $forums = $forumManager->getForums();
    
    require_once('view/adminForumsView.php');
}

// Ajouter une nouvelle catégorie forum
function addForumCat($userId, $forumCat)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->editForumCat($userId, $forumCat);
    
    header('Location: index.php?action=displayAdminForums');
}
?>