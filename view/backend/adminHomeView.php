<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>
<?php require_once('view/frontend/instantMessagesView.php'); ?>

<?php ob_start(); ?>

<section id="admin-home">
    
    <div>
        <h1>Administration du site</h1>
    </div>
    
    <div id="admin-home-content">
        <div id="admin-option">
            <div id="forum-option">
                <h2><i class="fas fa-cogs"></i> Forums</h2>
                <p><a href="index.php?action=displayAdminForums"><i class="fas fa-tools"></i><i class="fas fa-wrench"></i> Editer les forums et les topics</a></p>
                <p><a href="index.php?action=displayAdminReportedMessages"><i class="fas fa-wrench"></i> Messages signalés</a></p>
            </div>
            
            <div id="game-option">
                <h2><i class="fas fa-cogs"></i> Nos jeux</h2>
                <p><a href="index.php?action=displayAdminListGames"><i class="fas fa-wrench"></i> Editer</a></p>
            </div>
            
            <div id="account-option">
                <h2><i class="fas fa-cogs"></i> Compte</h2>
                <p><a href="index.php?action=displayAdminAllAccounts"><i class="fas fa-wrench"></i> Modifier les droits</a></p>
            </div>
        </div>
        
        <?= $messages ?>
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>