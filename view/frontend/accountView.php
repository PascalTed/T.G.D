<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="account">
    
    <div>
        <h1>Mon compte</h1>
    </div>
    
    <div id="account-content">

        <div id="account-infos">
            
            <div id="container-img-avatar">
                <img src="images/avatars/<?= $_SESSION['avatar'] ?>" id="image-avatar" alt="image avatar"/> 
                <a href="#" id="btn-modify-avatar">Modifier avatar</a>
            </div>
            
            <div id="infos-pseudo-email">
                <p>Pseudo : <?= $_SESSION['pseudo'] ?></p>
                <p>Email : <?= $_SESSION['email'] ?></p>
            </div>
        </div>
        
        <div id="form-avatar-window">
            <i class="fas fa-skull-crossbones fa-2x" id="close-avatar-window"></i>
       
            <form method="post" action="index.php?action=modifyAvatar" enctype="multipart/form-data" id="form-avatar">
                <input type="file" name="file-avatar" id="file-avatar" required/><br />
                <span id="accepted-file-avatar">Fichiers acceptés : jpeg ou png ou gif, maximum 1Mo.</span><br />
                <span id="max-file-avatar">Le fichier est trop gros.</span><br />
                <input type="submit" value="Envoyer" />
            </form>
        </div>        
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>