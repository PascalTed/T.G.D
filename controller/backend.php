<?php

// Chargement des classes
require_once('model/AccountManager.php');
require_once('model/InstantMessageManager.php');
require_once('model/GameManager.php');
require_once('model/ForumManager.php');
require_once('model/AdminForumManager.php');

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

// Vérifier si la catégorie d'un forum existe déjà avant la modification de celui-ci, Venant d'un ajaxpost (administration)
function verifyForum($forumCat)
{
    $adminForumManager = new AdminForumManager();
    $adminForumManager->searchForumCat($forumCat);
}

?>