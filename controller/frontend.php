<?php

use model\frontend\AccountManager;
use model\frontend\InstantMessageManager;
use model\frontend\GameManager;
use model\frontend\ForumManager;

// Affiche la page d'accueil
function displayHome()
{
    $messages = getAllmessages();
    
    $gameManager = new GameManager();
    $nbGames = $gameManager->getNbGames();
    
    $forumManager = new ForumManager();
    $nbForums = $forumManager->getNbForums();
    
    
    require_once('view/frontend/homeView.php');
}

// Affiche création d'un compte
function displayCreateAccount()
{
    require_once('view/frontend/registerAccountView.php');
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
    if (preg_match('#\s+#', $pseudo) == FALSE AND preg_match('#^\S+@\S+\.\S+$#', $mail) == TRUE) {        
        $accountManager = new AccountManager();
        $accountManager->editAccount($pseudo, $mail, $pass);
        
        header('Location: index.php');
    } else {
        throw new Exception('Le format du pseudo ou email n\'est pas respecté');
    }
}

// Modifier avatar
function modifyAvatar($imageAvatar, $userId)
{
    $accountManager = new AccountManager();
    $avatar = $accountManager->changeAvatar($imageAvatar, $userId);
    
    if ($avatar == 'Extension incorrecte') {
        throw new Exception('Extension incorrecte');
        
    } elseif ($avatar == 'Erreur lors du transfert') {
        throw new Exception('Erreur lors du transfert');
        
    } else {
        header('Location: index.php?action=displayAccount');
    }
    
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
    require_once('view/frontend/accountView.php');
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

        <div id="message-<?= $lastMessage['id'] ?>" class="message">
            <img src="images/avatars/<?= $lastMessage['avatar'] ?>" class="mini-image-avatar" alt="mini image avatar"/> 
            <!-- Les données sont protégées par htmlspecialchars -->
            <p class="message-pseudo"><strong><?= htmlspecialchars($lastMessage['pseudo']) ?></strong></p>
            <p class="message-date"><em>le <?= $lastMessage['message_date_fr'] ?></em></p>
            <p><?= nl2br(htmlspecialchars($lastMessage['message'])) ?></p>
        </div>

<?php
    }
    $messages->closeCursor();
}

// Afficher la page Nos jeux
function displayListGames()
{
    $gameManager = new GameManager();
    $games = $gameManager->getListGames();
    
    require_once('view/frontend/listGamesView.php');
}

// Afficher la page du jeu
function displayGame($gameId)
{
    $gameManager = new GameManager();
    $game = $gameManager->getGame($gameId);
    
    require_once('view/frontend/gameView.php');
}

// Afficher la page des forums
function displayForums()
{
    $forumManager = new ForumManager();
    $forums = $forumManager->getForums();
    
    require_once('view/frontend/forumsView.php');
}

// Afficher la page du forum et ses sujets
function displayForumTopics($forumId, $forumCat)
{
    $forumManager = new ForumManager();
    $topics = $forumManager->getTopics($forumId);
    
    require_once('view/frontend/forumTopicsView.php');
}

// Afficher la page du sujet et ses messages
function displayTopic($forumId, $forumCat, $topicId)
{
    $forumManager = new ForumManager();
    $topicMessages = $forumManager->getTopicMessages($topicId);
    
    $infoTopic = $forumManager->getInfoTopic($topicId);
    
    require_once('view/frontend/topicView.php');
}

// Afficher la page créer un sujet
function displayCreateTopic($forumId, $forumCat)
{
    require_once('view/frontend/createTopicView.php');
}

// Vérifier si le topic existe déjà avant la modification ou la création de celui-ci, Venant d'un ajaxpost
function verifyTopic ($titleTopic)
{
    $forumManager = new ForumManager();
    $forumManager->searchTopic($titleTopic);
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
}

// Mettre à jour la liste des messages d'un topic
function updateMessages($topicId)    
{
    $forumManager = new ForumManager();
    $topicMessages = $forumManager->getTopicMessages($topicId);
    
    while ($topic = $topicMessages->fetch()) {
    ?>
        
        <div class="all-messages-topic">
            <div class="info-user">
                <p><img src="images/avatars/<?= $topic['avatar'] ?>" alt="image avatar" class="topic-image-avatar" /></p>
                <!-- Les données sont protégées par htmlspecialchars -->
                <p><strong><?= htmlspecialchars($topic['pseudo']) ?></strong></p>
                <p>Inscrit le <?= $topic['registration_date'] ?></p>
            </div>

            <div class="info-message">
                <p><em><strong>le <?= $topic['message_date'] ?></strong></em></p>  
                <div><?= $topic['message'] ?></div>

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
                ?>

            </div>
        </div>
            
    <?php
    }
    $topicMessages->closeCursor();
}

// Signaler un message d'un topic
function reportTopicMessage($messageId, $topicId)
{
    $forumManager = new ForumManager();
    $forumManager->editReport($messageId);
    
    $actualizeMessages = updateMessages($topicId);
}

?>