<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-edit-game">
    
    <div id="admin-edit-game-return">
        <p><a href="index.php?action=displayAdminListGames"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>

    <div>
        <h1><?= $game['title']; ?></h1>
    </div>

    <div id ="admin-edit-game-content">

        <form action="index.php?action=modifyOrRemoveGame&amp;idGame=<?= $game['id'] ?>" id="form-edit-game" method="post" enctype="multipart/form-data">
            <div>
                <label for="edit-title-game"><strong>Modifier le titre</strong></label><br />
                <textarea id="edit-title-game" name="edit-title-game"><?= $game['title']; ?></textarea>
                <span id="no-edit-title-game" class="messages-edit-game">Le champ titre est vide.</span>
            </div>
            
            <div>
                <label for="edit-date-game"><strong>Modifier la date de sortie</strong></label><br />
                <textarea id="edit-date-game" name="edit-date-game"><?= $game['release_date']; ?></textarea>
                <span id="no-edit-date-game" class="messages-edit-game">Le champ date de sortie est vide.</span>
            </div>
            
            <div>
                <label for="edit-type-game"><strong>Modifier le genre</strong></label><br />
                <textarea id="edit-type-game" name="edit-type-game"><?= $game['type']; ?></textarea>
                <span id="no-edit-type-game" class="messages-edit-game">Le champ genre est vide.</span>
            </div>
            
            <div>
                <label for="edit-file-game"><strong>Modifier l'image</strong></label><br />
                <img src="images/games/<?= $game['image'] ?>" id="edit-file-game-img" class="image-edit-game" alt="image du jeu à modifier"/>
                <input type="file" name="edit-file-game" id="edit-file-game" /><br />
                <span id="accepted-edit-file-game">Fichiers acceptés : jpeg ou png, maximum 2Mo.</span><br />
                <span id="max-edit-file-game" class="messages-edit-game">Le fichier est trop gros.</span>
                <span id="exist-edit-file-game" class="messages-edit-game">Aucun fichier choisi.</span>
            </div>

            <div>
                <label for="edit-content-game"><strong>Modifier le contenu</strong></label><br />
                <textarea id="edit-content-game" name="edit-content-game"><?= $game['content']; ?></textarea>
                <span id="no-edit-content-game" class="messages-edit-game">Le champ contenu est vide.</span>
            </div>

            <div id="game-radio">
                <div>
                    <label for="adm-modify-game">Modifier le sujet</label>
                    <input type="radio" name="setGame" value="adm-modify-game" id="adm-modify-game" checked />
                </div>
                
                <div>
                    <label for="adm-remove-game">Supprimer le sujet</label>
                    <input type="radio" name="setGame" value="adm-remove-game" id="adm-remove-game" />
                </div>
            </div>
                <input type="submit" value="Envoyer" />
        </form>

    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
