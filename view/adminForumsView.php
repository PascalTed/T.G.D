<?php require_once('adminMenuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-forums">

    <div>
        <h1 id="admin-forums-title">Editer les forums</h1>
    </div>
    
    <div id="admin-forums-content">
        
        <?php    
        while ($forum = $forums->fetch()) {
        ?>
        
            <div class="admin-edit-forum">
                <div class="admin-forum-cat-topics">
                    <h2><a href="index.php?action=displayForumTopics&amp;idForum=<?= $forum['id'] ?>&amp;catForum=<?= $forum['categories'] ?>"><?= $forum['categories'] ?></a>
                    </h2>
                    <div><?= $forum['nb_topics'] ?> sujets</div>
                </div>
                        
                <form action="index.php?action=modifyOrRemoveForum&amp;idForum=<?= $forum['id'] ?>" class="form-edit-forum" method="post">
                    <label>Modifier le nom du forum<br />
                        <textarea class="textarea-cat-forum" name="textarea-cat-forum"><?= strip_tags($forum['categories']); ?></textarea>
                    </label>
     
                    <div class="forum-radio">
                        <label><input type="radio" name="setForum" value="modify-forum-cat" class="adm-modify-forum" checked />Modifier le nom du forum</label>
            
                        <label><input type="radio" name="setForum" value="remove-forum-cat" class="adm-remove-forum" />Supprimer le forum</label><br />
                    </div>
            
                    <input type="submit" value="Envoyer" />
                </form>
             </div>
        
        <?php
        }
        ?>
        
        <div id="add-forum-content">
            <form action="index.php?action=addForumCat" method="post" id="form-add-forum">
                <label for="add-forum">Ajouter un forum</label><br />
                <textarea type="text" id="add-forum" name="add-forum"></textarea>
                <span id="forum-message-required">Le champ message n'est pas rempli.</span>
                <input type="submit" value="Envoyer" />
            </form>
        </div>
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>