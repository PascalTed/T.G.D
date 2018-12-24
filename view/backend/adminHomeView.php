<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>
<?php require_once('view/frontend/instantMessagesView.php'); ?>

<?php ob_start(); ?>

<section id="admin-home">
    
    <div>
        <h1>Administration du site</h1>
    </div>
    
    <div id="admin-home-content">
        <div>
            <?= $messages ?>
            <p>Accueil</p>
        </div>

        <div>
            <ul>
                <li><a href="index.php?action=displayAdminForums"><i class="fas fa-cogs"></i>Forums</a></li>
                <li><a href=""><i class="fas fa-cogs"></i>Nos jeux</a></li>
                <li><a href=""><i class="fas fa-cogs"></i>Compte</a></li>
            </ul>
        </div>
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>