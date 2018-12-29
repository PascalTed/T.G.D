<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-infos-account">
    
    <div>
        <h1>Informations du compte utilisateur</h1>
    </div>

    <div id="admin-infos-account-content">

            <div>
                <p><img src="images/avatars/<?= $infoAccount['avatar'] ?>" alt="image avatar"/><?= $infoAccount['pseudo'] ?></p>
                <p>Inscrit le : <?= $infoAccount['registration_date'] ?></p>
                <p>Email : <?= $infoAccount['email'] ?></p>
                <p>droits : <?= $infoAccount['user_right'] ?></p>
                <p>Modifié les droits</p>
                
                <form action="index.php?action=addRights" method="post" id="form-add-rights">      
                    <label for="admin-rights">Droits administrateur</label>
                    <input type="radio" name="setRights" value="admin-rights" id="admin-rights"/>
                    <label for="none-rights">Droits administrateur</label>
                    <input type="radio" name="setRights" value="none-rights" id="none-rights"/>
                </form>

            </div>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>