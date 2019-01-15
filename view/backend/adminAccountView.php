<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-infos-account">
    
    
    <div id="admin-infos-account-return">
        <p><a href="index.php?action=displayAdminAllAccounts"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <h1>Informations du compte</h1>
    </div>

    <div id="admin-account-content">
        <div id="admin-account-img-info">
            <div id="admin-account-img">
                <img src="images/avatars/<?= $infoAccount['avatar'] ?>" alt="image avatar"/>
            </div>

            <div id="admin-account-info">
                <!-- Les données sont protégées par htmlspecialchars -->
                <p><strong><?= htmlspecialchars($infoAccount['pseudo']) ?></strong></p>
                <p><strong>inscrit le : </strong><?= $infoAccount['registration_date'] ?></p>
                <p><strong>email : </strong><?= htmlspecialchars($infoAccount['email']) ?></p>

                <?php
                switch ($infoAccount['user_right']) {
                case 'admin':
                    $rights = "administrateur";
                     break;
                case 'none':
                    $rights = "aucun";
                    break;
                }
                ?>

                <p><strong>droits : </strong><?= $rights ?></p>

            </div>
        </div>
        
        <div id="admin-account-form">
            <p><strong>Modifier les droits</strong></p>

            <form action="index.php?action=addOrRemoveRights&amp;idUser=<?=$infoAccount['id'] ?>" method="post" id="form-add-rights">

                <?php
                if ($infoAccount['user_right'] == "none") {
                ?>

                <label for="admin-rights">droits administrateur</label>
                <input type="radio" name="setRights" value="admin-rights" id="admin-rights" required/>

                <?php
                }
                if ($infoAccount['user_right'] == "admin") {
                ?>

                <label for="none-rights">aucun droits</label>
                <input type="radio" name="setRights" value="none-rights" id="none-rights" required/>

                <?php
                }
                ?>

                <div>
                    <input type="submit" value="Envoyer" />
                </div>
            </form>
        </div>  
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>