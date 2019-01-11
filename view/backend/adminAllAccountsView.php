<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-all-accounts">
    
    <div id="admin-all-accounts-return">
        <p><a href="index.php?action=displayAdminHome"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <h1 id="">Comptes</h1>
    </div>

    <div id="admin-all-accounts-content">
        
        <?php
        while ($Account = $allAccounts->fetch()) {
        ?>
        
            <div class="all-account-img-info">
                <div class="all-account-img">
                    <img src="images/avatars/<?= $Account['avatar'] ?>" alt="image avatar"/>
                </div>
                
                <div class="all-account-info">
                    <!-- Les données sont protégées par htmlspecialchars -->
                    <p><strong><?= htmlspecialchars($Account['pseudo']) ?></strong></p>
                    
                    <?php
                    switch ($Account['user_right']) {
                    case 'admin':
                        $rights = "administrateur";
                         break;
                    case 'none':
                        $rights = "aucun";
                        break;
                    }
                    ?>
                    
                    <p><strong>droits : </strong><?= $rights ?> <a href="index.php?action=displayAdminAccount&amp;idUser=<?= $Account['id'] ?>">(modifier)</a></p>
                    <p><strong>inscrit le : </strong><?= $Account['registration_date'] ?></p>
                </div>
            </div>
        
        <?php
        }
        $allAccounts->closeCursor();
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>