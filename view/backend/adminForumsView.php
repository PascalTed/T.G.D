<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-forums">
    
    <div id="admin-forums-return">
        <p><a href="index.php?action=displayAdminHome"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>

    <div>
        <h1 id="admin-forums-title">Forums</h1>
    </div>
    
    <div id="add-forum-content">
        <form action="index.php?action=addForumCat" method="post" id="form-add-forum">
            <label for="add-forum"><strong>Ajouter un forum</strong></label><br />
            <textarea type="text" id="add-forum" name="add-forum"></textarea>
            <span id="add-forum-exist">Ce forum existe déjà.</span>
            <span id="add-forum-empty">Le champ forum est vide</span>
            <input type="submit" value="Envoyer" />
        </form>
    </div>
    
    <div id="admin-forums-content">
         
        <?php
        $countForums = $forums->rowcount();
        if ($countForums == 0) {
        ?>
        
            <p id="no-admin-list-forums">Aucun forums</p>
        
        <?php
        } else {
            while ($forum = $forums->fetch()) {
            ?>
                <div class="admin-forum-cat-topics">
                    <h2>
                        <!-- Les données sont protégées par htmlspecialchars -->
                        <a href="index.php?action=displayAdminForumTopics&amp;idForum=<?= $forum['id'] ?>&amp;catForum=<?= $forum['categories'] ?>"><?= htmlspecialchars($forum['categories']) ?></a>
                    </h2>
                    <p><strong><?= $forum['nb_topics'] ?> sujet(s)</strong></p>
                </div>

        <?php
            }
            $forums->closeCursor();
        }
        ?>

    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>