<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="create-topic">
    
    <div><a href="index.php?action=displayForumTopics&amp;idForum=<?= $forumId ?>">Forum <?= $forumCat ?></a>
    </div>
    
    <div>
        <form class="form-tiny-mce" action="index.php?action=createTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>" method="post" id="form-create-topic">
            <p>
                <label for="create-title-topic">Ajouter le titre</label>
                <textarea id="create-title-topic" name="create-title-topic"></textarea>
                <span id="no-title-topic"></span>

                <label for="create-content-topic">Ajouter le contenu</label>
                <textarea id="create-content-topic" name="create-content-topic"></textarea>
                <span id="no-content-topic"></span>
                
                <input type="submit" value="Ajouter le sujet" />
            </p>
         </form>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>