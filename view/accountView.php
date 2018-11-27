<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>
<?php require_once('instantMessagesView.php'); ?>

<?php ob_start(); ?>

<section id="account">
    
    <div>
        <h1>Mon compte</h1>
    </div>
    
    <div id="account-content">

        <div id="infos-account">
            
            <div id="container-img-avatar">
                
                <?php 
                if ($_SESSION['avatar'] == "default") {
                ?>
            
                <img src="images/avatars/default.jpg" id="image-avatar" />
            
                <?php
                } else {
                ?>
            
                <img src="images/avatars/<?= $_SESSION['id'] . '.' . $_SESSION['avatar'] ?>" id="image-avatar" />
            
                <?php
                }
                ?>
                
                <a href="#" id="modify-avatar">Modifier avatar</a>
            </div>
            
            <div id="infos-pseudo-email">
                <p>Pseudo : <?= $_SESSION['pseudo'] ?></p>
                <p>Email : <?= $_SESSION['email'] ?></p>
            </div>
            
            <div id="display-form-avatar">
                <i class="fas fa-skull-crossbones fa-2x" id="close-avatar-window"></i>
       
                <form method="post" action="index.php?action=modifyAvatar" enctype="multipart/form-data" id="form-avatar">
                        <input type="file" name="file-avatar" id="file-avatar" required/>
                        <input type="submit" name="submit" value="Envoyer" />
                </form>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>