<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-topic">
    
    <div>
        <p><a href="index.php?action=displayAdminForums">Forum</a><span>/</span><a href="index.php?action=displayAdminForumTopics&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>"><?= $forumCat ?></a><span>/</span><?= $infoTopic['topicTitle'] ?></p>
    </div>
    
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