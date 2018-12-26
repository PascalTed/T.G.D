<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-topic">
    
    <div>
        <p><a href="index.php?action=displayAdminForums">Forum</a><span>/</span><a href="index.php?action=displayAdminForumTopics&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>"><?= $forumCat ?></a><span>/</span><?= $infoTopic['topicTitle'] ?></p>
    </div>
    
    <form action="index.php?action=modifyOrRemoveTopic&amp;idTopic=<?= $topicId ?>&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>" id="form-edit-topic" method="post">
        <label for="textarea-edit-topic">Modifier le nom du topic</label><br />
        <textarea id="textarea-edit-topic" name="textarea-edit-topic"><?= strip_tags($infoTopic['topicTitle']); ?></textarea>
        <span id="topic-exist">Ce forum existe déjà.</span>
        <div id="topic-radio">
            <label for ="adm-modify-topic">Modifier le nom du forum</label>
            <input type="radio" name="setTopic" value="adm-modify-topic" id="adm-modify-topic" checked />
                
            <label for ="adm-remove-topic">Supprimer le forum</label>
            <input type="radio" name="setTopic" value="adm-remove-topic" id="adm-remove-topic" />
        </div>
        <input type="submit" value="Envoyer" />
    </form>
    
    <div>
        <div>
            <p><?= $infoTopic['topicTitle'] ?></p><em>Créé le <?= $infoTopic['topicDate'] ?></em>
        </div>
        
        <div id="admin-all-messages-topic">
        
            <?php    
            while ($topic = $topicMessages->fetch()) {
            ?>

                <div><p>posté par <?= $topic['pseudo'] ?></p></div>
                <div>message  <?= $topic['message'] ?></div>
                <div>Date du message : <?= $topic['message_date'] ?></div>  

                <?php
                if ($topic['moderation'] == 1) {
                ?>
                    <p class="admin-message-reported">Message signalé</p>
            <?php
                }
            }
            ?>
            
        </div>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>