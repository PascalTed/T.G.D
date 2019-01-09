<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-forum">
    
    <div id="admin-forum-return">
        <p><a href="index.php?action=displayAdminForums"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <!-- Les données sont protégées par htmlspecialchars -->
        <h1>Forum <?= htmlspecialchars($forumCat) ?></h1>
    </div>
    
    <div id="rename-forum-content">
        <form action="index.php?action=modifyOrRemoveForum&amp;idForum=<?= $forumId ?>" id="form-edit-forum" method="post">
            <label for="textarea-cat-forum">Modifier le nom du forum</label><br />
            <textarea id="textarea-cat-forum" name="textarea-cat-forum"><?= strip_tags($forumCat); ?></textarea>
            <span id="forum-exist">Ce forum existe déjà.</span>
            <span id="no-forum">Le champ forum est vide.</span>
            <div id="forum-radio">
                <label for ="adm-modify-forum">Modifier le nom du forum</label>
                <input type="radio" name="setForum" value="adm-modify-forum" id="adm-modify-forum" checked />

                <label for ="adm-remove-forum">Supprimer le forum</label>
                <input type="radio" name="setForum" value="adm-remove-forum" id="adm-remove-forum" />
            </div>
            <input type="submit" value="Envoyer" />
        </form>
    </div>
    
    <div id="admin-topics-content">
        
        <?php
        $countTopics = $topics->rowcount();
        if ($countTopics == 0) {
        ?>
        
            <div>
                <p id="no-admin-list-topics">Aucun sujet de créé.</p>
            </div>
        
        <?php
        } else {
            while ($topic = $topics->fetch()) {
        ?>
        
                <div class="admin-topic-messages">
                    <div>
                        <h2>
                            <a href="index.php?action=displayAdminTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>&amp;idTopic=<?= $topic['topicID'] ?>"><?= $topic['title'] ?> <?= $topic['nb_message'] ?> messages</a>
                        </h2>
                    </div>

                    <div><p>posté par <?= $topic['t_pseudo'] ?> le <?= $topic['creation_date'] ?></p></div>

                    <div>dernier message par <?= $topic['tm_pseudo'] ?> le <?= $topic['last_date'] ?></div>
                </div>
        
        <?php
            }
        }
        $topics->closeCursor();
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>