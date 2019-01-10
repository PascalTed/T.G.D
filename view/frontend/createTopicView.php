<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="create-topic">
    
    <div id="create-topic-return">
        <p><a href="index.php?action=displayForumTopics&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <!-- Les données sont protégées par htmlspecialchars -->
        <h1>Ajouter un sujet au forum <?= htmlspecialchars($forumCat) ?></h1>
    </div>
    
    <div id=create-topic-content>
        <form class="form-tiny-mce" action="index.php?action=createTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>" method="post" id="form-create-topic">
            
            <div id="">
                <label for="create-title-topic"><strong>Ajouter le titre</strong></label>
                <textarea id="create-title-topic" name="create-title-topic"></textarea>
                <span id="topic-exist">Ce topic existe déjà</span>
                <span id="no-title-topic">Le champ titre est vide</span>
            </div>
            
            <div>
                <label for="create-content-topic"><strong>Ajouter le message</strong></label>
                <textarea id="create-content-topic" name="create-content-topic"></textarea>
                <span id="no-content-topic">Le champ contenu est vide</span>
            </div>
            
            <input type="submit" value="Ajouter le sujet" />

         </form>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>