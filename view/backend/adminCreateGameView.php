<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-create-game">
    
    <div id="admin-create-game-return">
        <p><a href="index.php?action=displayAdminListGames"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>

    <div>
        <h1>Ajouter un jeu</h1>
    </div>
        
    <div id="admin-create-game-content">
        
        <form class="form-tiny-mce" action="index.php?action=createGame" method="post" id="form-create-game" enctype="multipart/form-data">
            <div>
                <label for="title-game"><strong>Ajouter le titre</strong></label>
                <textarea id="title-game" name="title-game"></textarea>
                <span id="no-title-game" class="messages-create-game">Le champ titre est vide.</span>
            </div>
            
            <div>
                <label for="release-date-game"><strong>Ajouter la date de sortie</strong></label>
                <textarea id="release-date-game" name="release-date-game"></textarea>
                <span id="no-date-game" class="messages-create-game">Le champ date est vide.</span>
            </div>
            
            <div>
                <label for="type-game"><strong>Ajouter le genre (ex: FPS)</strong></label>
                <textarea id="type-game" name="type-game"></textarea>
                <span id="no-type-game" class="messages-create-game">Le champ genre est vide.</span>
            </div>
            
            <div>
                <label for="file-game"><strong>Ajouter l'image</strong></label><br/>
                <input type="file" name="file-game" id="file-game" required/><br/>
                <span id="accepted-file-game">Fichiers acceptés : jpeg ou png, maximum 2Mo.</span><br />
                <span id="max-file-game" class="messages-create-game">Le fichier est trop gros.</span>
            </div>

            <div>    
                <label for="content-game"><strong>Ajouter le contenu</strong></label>
                <textarea id="content-game" name="content-game"></textarea>
                <span id="no-content-game" class="messages-create-game">Le champ contenu est vide.</span>
            </div>
        
            <input type="submit" value="Ajouter le jeu" />

        </form>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>