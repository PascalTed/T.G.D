<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-edit-game">

    <div>
        <h1>Détails du jeu</h1>
    </div>

    <div>
        <p>
            <a href="index.php?action=displayAdminListGames">Editer Nos jeux</a><span>/</span>
            <?= $game['title']; ?>
        </p>
    </div>

    <div id ="admin-edit-game-content">

        <form action="index.php?action=modifyOrRemoveGame&amp;idGame=<?= $game['id'] ?>" id="form-edit-game" method="post" enctype="multipart/form-data">
            <p>
                <label for="edit-title-game">Modifier le titre</label><br />
                <textarea id="edit-title-game" name="edit-title-game"><?= $game['title']; ?></textarea><br />
                <span id="no-edit-title-game" class="messages-edit-game">Le champ titre est vide.</span>
            </p>

            <p>
                <label for="edit-content-game">Modifier le contenu</label><br />
                <textarea id="edit-content-game" name="edit-content-game"><?= $game['content']; ?></textarea><br />
                <span id="no-edit-content-game" class="messages-edit-game">Le champ contenu est vide.</span>
            </p>

            <p>
                <img src="images/games/<?= $game['image'] ?>" class="image-edit-game" alt="image du jeu à modifier"/>
                <label for="edit-file-game">Modifier l'image</label><br />
                <input type="file" name="edit-file-game" id="edit-file-game" required /><br />
                <span id="accepted-edit-file-game">Fichiers acceptés : jpeg ou png, maximum 2Mo.</span><br />
                <span id="max-edit-file-game" class="messages-edit-game">Le fichier est trop gros.</span>
            </p>

            <p>
                <label for="edit-type-game">Modifier le genre</label><br />
                <textarea id="edit-type-game" name="edit-type-game"><?= $game['type']; ?></textarea><br />
                <span id="no-edit-type-game" class="messages-edit-game">Le champ genre est vide.</span>
            </p>
            <p>
                <label for="edit-date-game">Modifier la date de sortie</label><br />
                <textarea id="edit-date-game" name="edit-date-game"><?= $game['release_date']; ?></textarea><br />
                <span id="no-edit-date-game" class="messages-edit-game">Le champ genre est vide.</span>
            </p>

            <div id="game-radio">
                <label for="adm-modify-game">Modifier le sujet</label>
                <input type="radio" name="setGame" value="adm-modify-game" id="adm-modify-game" checked />

                <label for="adm-remove-game">Supprimer le sujet</label>
                <input type="radio" name="setGame" value="adm-remove-game" id="adm-remove-game" /><br />
                <input type="submit" value="Envoyer" />
            </div>
        </form>

    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
