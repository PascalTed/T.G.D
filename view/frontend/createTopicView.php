<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="create-topic">
    <!-- Les données sont protégées par htmlspecialchars -->
    <div><a href="index.php?action=displayForumTopics&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>">Forum <?= htmlspecialchars($forumCat) ?></a>
    </div>
    
    <div>
        <form class="form-tiny-mce" action="index.php?action=createTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>" method="post" id="form-create-topic">
            <p>
                <label for="create-title-topic">Ajouter le titre</label>
                <textarea id="create-title-topic" name="create-title-topic"></textarea>
                <span id="topic-exist">Ce topic existe déjà</span>
                <span id="no-title-topic">Le champ titre est vide</span>

                <label for="create-content-topic">Ajouter le contenu</label>
                <textarea id="create-content-topic" name="create-content-topic"></textarea>
                <span id="no-content-topic">Le champ contenu est vide</span>
                
                <input type="submit" value="Ajouter le sujet" />
            </p>
         </form>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>