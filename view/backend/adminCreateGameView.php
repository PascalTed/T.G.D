<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-create-game">

    <div>
        <h1>Ajouté un jeu joué</h1>
    </div>
        
    <div>
        <p>
            <a href="index.php?action=displayAdminListGames">Editer nos jeux</a><span>/</span>Ajouter un jeu
        </p>
    </div>
        
    <div id="admin-create-game-content">
        
        <form class="form-tiny-mce" action="index.php?action=createGame" method="post" id="form-create-game" enctype="multipart/form-data">
            <p>
                <label for="title-game">Ajouter le titre</label><br />
                <textarea id="title-game" name="title-game"></textarea><br />
                <span id="no-title-game" class="messages-create-game">Le champ titre est vide.</span>
            </p>
            
            <p>
                <label for="release-date-game">Ajouter la date de sortie</label><br />
                <textarea id="release-date-game" name="release-date-game"></textarea><br />
                <span id="no-date-game" class="messages-create-game">Le champ date est vide.</span>
            </p>
            
            <p>
                <label for="type-game">Ajouter le genre (ex: FPS)</label><br />
                <textarea id="type-game" name="type-game"></textarea><br />
                <span id="no-type-game" class="messages-create-game">Le champ genre est vide.</span>
            </p>
            
            <p>
                <label for="file-game">Ajouter l'image</label><br />
                <input type="file" name="file-game" id="file-game" required/><br />
                <span id="accepted-file-game">Fichiers acceptés : jpeg ou png, maximum 2Mo.</span><br />
                <span id="max-file-game" class="messages-create-game">Le fichier est trop gros.</span>
            </p>

            <p>    
                <label for="content-game">Ajouter le contenu</label><br />
                <textarea id="content-game" name="content-game"></textarea><br />
                <span id="no-content-game" class="messages-create-game">Le champ contenu est vide.</span>
            </p>
            
            <p>
                <input type="submit" value="Ajouter le jeu" />
            </p>
        </form>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>