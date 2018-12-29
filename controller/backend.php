<?php

// Chargement des classes
require "vendor/autoload.php";

use model\backend\AdminForumManager;
use model\backend\AdminAccountManager;
use model\frontend\InstantMessageManager;
use model\frontend\ForumManager;

// Afficher la page accueil (administration)
function displayAdminHome()
{
    $messages = getAllmessages();
    require_once('view/backend/adminHomeView.php');
}

// Afficher la page forums (administration)
function displayAdminForums()
{
    $forumManager = new ForumManager();
    $forums = $forumManager->getForums();
    
    require_once('view/backend/adminForumsView.php');
}

// Ajouter une nouvelle catégorie forum (administration)
function addForumCat($userId, $forumCat)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->editForumCat($userId, $forumCat);
    
    header('Location: index.php?action=displayAdminForums');
}

// Modifier une catégorie forum (administration)
function modifyForumCat($userId, $forumCat, $forumId)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->updateForumCat($userId, $forumCat, $forumId);
    
    header('Location: index.php?action=displayAdminForums');
}

// Supprimer une catégorie forum (administration)
function removeForumCat($forumId)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->deleteForumCat($forumId);

    $adminForumManager->deleteTopicsOfForum($forumId);

    $adminForumManager->deleteMessagesOfForum($forumId);
    
    header('Location: index.php?action=displayAdminForums');
}

// Vérifier si la catégorie d'un forum existe déjà avant la modification ou la création de celui-ci, Venant d'un ajaxpost (administration)
function verifyForum($forumCat)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->searchForumCat($forumCat);
}

// Afficher la page du forum et ses sujets (administration)
function displayAdminForumTopics($forumId, $forumCat)
{
    $forumManager = new ForumManager();
    $topics = $forumManager->getTopics($forumId);
    
    require_once('view/backend/adminForumTopicsView.php');
}

function displayAdminTopic($forumId, $forumCat, $topicId)
{
    $forumManager = new ForumManager();
    $topicMessages = $forumManager->getTopicMessages($topicId);
    
    $infoTopic = $forumManager->getInfoTopic($topicId);
    
    require_once('view/backend/adminTopicView.php');
}

function modifyTopic($userId, $titleTopic, $topicId, $forumId, $forumCat)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->updateTopic($userId, $titleTopic, $topicId);
    
    header('Location: index.php?action=displayAdminForumTopics&idForum=' . $forumId . '&catForum=' . $forumCat);
}

function removeTopic($topicId, $forumId, $forumCat)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->deleteTopic($topicId);

    $adminForumManager->deleteMessagesOfTopic($topicId);
    
    header('Location: index.php?action=displayAdminForumTopics&idForum=' . $forumId . '&catForum=' . $forumCat);
}

// Supprimer le message d'un topic (administration)
// Si celuic-ci est le premier message du topic, le topic et tous ses messages seront supprimés 
function removeTopicMessage($messageId, $forumId, $forumCat, $topicId)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->deleteMessage($messageId, $topicId);
    
    header('Location: index.php?action=displayAdminForumTopics&idForum=' . $forumId . '&catForum=' . $forumCat);
}

// Afficher la page des messages signalés des topics (administration))
function displayAdminReportedMessages()
{
    $adminForumManager = new AdminForumManager();
    $reportedMessages = $adminForumManager->getReportedMessages();
    
    require_once('view/backend/adminReportedMessagesView.php');
}

// Valider le message signalé d'un topic (administration)
function validMessage($messageId)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->validateMessage($messageId);
    
    header('Location: index.php?action=displayAdminReportedMessages');
}

// Supprimer le message signalé d'un topic (administration)
function removeMessage($messageId, $topicId)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->deleteMessage($messageId, $topicId);
    
    header('Location: index.php?action=displayAdminReportedMessages');
}

// Afficher la page des comptes utilisateurs (administration)
function displayAdminAllAccounts()
{
    $adminAccountManager = new AdminAccountManager();
    $allAccounts = $adminAccountManager->getAllAccounts();
    
    require_once('view/backend/adminAllAccountsView.php');
}

// Afficher la page infos compte utilisateur (administration)
function displayAdminAccount($_GET['pseudo']);
{
    $adminAccountManager = new AdminAccountManager();
    $InfosAccount = $adminAccountManager->getInfosAccount();
    
    require_once('view/backend/adminAccountView.php');
}

?>