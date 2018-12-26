<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-forums">

    <div>
        <h1 id="admin-forums-title">Editer les forums</h1>
    </div>
    
    <div id="admin-forums-content">
        
        <?php    
        while ($forum = $forums->fetch()) {
        ?>
        
            <div class="admin-forum-cat-topics">
                <h2>
                    <a href="index.php?action=displayAdminForumTopics&amp;idForum=<?= $forum['id'] ?>&amp;catForum=<?= $forum['categories'] ?>"><?= $forum['categories'] ?> (<?= $forum['nb_topics'] ?> sujets)</a>
                </h2>
            </div>
    
        <?php
        }
        ?>
        
        <div id="add-forum-content">
            <form action="index.php?action=addForumCat" method="post" id="form-add-forum">
                <label for="add-forum">Ajouter un forum</label><br />
                <textarea type="text" id="add-forum" name="add-forum" required></textarea>
                <span id="forum-exist">Ce forum existe déjà.</span>
                <input type="submit" value="Envoyer" />
            </form>
        </div>
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>