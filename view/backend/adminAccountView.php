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
                
                <?php
                switch ($infoAccount['user_right']) {
                case 'admin':
                    $rights = "Administrateur";
                    break;
                case 'none':
                    $rights = "Aucun";
                    break;
                }
                ?>
                
                <p>droits : <?= $rights ?></p>
            </div>
        
            <div>
                <p>Modifier les droits</p>
                
                <form action="index.php?action=addOrRemoveRights" method="post" id="form-add-rights">
    
                    <?php
                    if ($infoAccount['user_right'] == "none") {
                    ?>
                    
                    <label for="admin-rights">Droits administrateur</label>
                    <input type="radio" name="setRights" value="admin-rights" id="admin-rights" required/>
                    
                    <?php
                    }
                    if ($infoAccount['user_right'] == "admin") {
                    ?>
                    
                    <label for="none-rights">Aucun droits</label>
                    <input type="radio" name="setRights" value="none-rights" id="none-rights" required/>
                    
                    <?php
                    }
                    ?>
                    
                    <div>
                        <input type="reset" value="Annuler" />
                        <input type="submit" value="Envoyer" />
                    </div>
                </form>
            </div>
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>