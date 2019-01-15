<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="account">
    
    <div id="account-return">
        <p><a href="index.php"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <h1>Mon compte</h1>
    </div>
    
    <div id="account-content">

        <div id="account-infos">
            
            <div id="container-img-avatar">
                <img src="images/avatars/<?= $_SESSION['avatar'] ?>" id="image-avatar" alt="image avatar"/> 
                <p><a href="#" id="btn-modify-avatar">Modifier avatar</a></p>
            </div>
            <!-- Les données sont protégées par htmlspecialchars -->
            <div id="infos-pseudo-email">
                <p><strong>Pseudo : </strong><?= htmlspecialchars($_SESSION['pseudo']) ?></p>
                <p><strong>Email : </strong><?= htmlspecialchars($_SESSION['email']) ?></p>
            </div>
        </div>
        
        <div id="form-avatar-window">
            <i class="fas fa-skull-crossbones fa-2x" id="close-avatar-window"></i>
       
            <form method="post" action="index.php?action=modifyAvatar" enctype="multipart/form-data" id="form-avatar">
                <input type="file" name="file-avatar" id="file-avatar" required/>
                <span id="max-file-avatar">Le fichier est trop gros.</span>
                <span id="incorrect-file-avatar">Extension incorrecte.</span><br />
                <span id="accepted-file-avatar">Fichiers acceptés : jpeg ou png, maximum 1Mo.</span>
                <br/>
                <input type="submit" value="Envoyer" />
            </form>
        </div>        
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>