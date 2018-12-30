<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-create-game">

    <div>
        <h1>Ajouté un jeu joué</h1>
        <form class="form-tiny-mce" action="" method="post" id="form-create-game" enctype="multipart/form-data">
            <p>
                <label for="title-game">Ajouter le titre</label><br />
                <textarea id="title-game" name="title-game"></textarea><br />
                <span id="no-title-game">Le champ titre est vide</span>
            </p>
            
            <p>
                <label for="release-date-game">Ajouter la date de sortie</label><br />
                <textarea id="release-date-game" name="release-date-game"></textarea><br />
                <span id="no-date-game">Le champ est vide</span>
            </p>
            
            <p>
                <label for="file-game">Ajouter l'image</label><br />
                <input type="file" name="file-game" id="file-game" required/>
            </p>

            <p>    
                <label for="content-game">Ajouter le contenu</label><br />
                <textarea id="content-game" name="content-game"></textarea><br />
                <span id="no-content-game">Le champ contenu est vide</span>
            </p>
            
            <p>
                <input type="submit" value="Ajouter le jeu" />
            </p>
            
         </form>
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>