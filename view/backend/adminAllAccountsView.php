<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-all-accounts">
    
    <div>
        <h1 id="">Liste des utilisateurs</h1>
    </div>

    <div id="admin-all-accounts-content">
        
        <?php
        while ($Account = $allAccounts->fetch()) {
        ?>
        
            <div>
                <p><a href="index.php?action=displayAdminAccount&amp;idUser=<?= $Account['id'] ?>"><?= $Account['pseudo'] ?></a></p>
                <p>Inscrit le : <?= $Account['registration_date'] ?></p>
                <p>droits : <?= $Account['user_right'] ?></p>
            </div>
        
        <?php
        }
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>