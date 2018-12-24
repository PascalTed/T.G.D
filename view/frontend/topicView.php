<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="topic">

    <div>
        <p><a href="index.php?action=displayForums">Forum</a><span>/</span><a href="index.php?action=displayForumTopics&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>"><?= $forumCat ?></a><span>/</span><?= $infoTopic['topicTitle'] ?></p>
    </div>
    
    <div>
        <div>
            <p><?= $infoTopic['topicTitle'] ?></p><em>Créé le <?= $infoTopic['topicDate'] ?></em>
        </div>
        
        <div id="all-messages-topic">
            <p id="none-messages-topic">Aucun message</p>
            
            <?php    
            while ($topic = $topicMessages->fetch()) {
            ?>

                <div><p>posté par <?= $topic['pseudo'] ?></p></div>
                <div>message  <?= $topic['message'] ?></div>
                <div>Date du message : <?= $topic['message_date'] ?></div>  

                <?php
                if (isset($_SESSION['pseudo'])) {
                    if ($topic['moderation'] == 1) {
                    ?>
                        <p class="already-report">Message signalé</p>
                    <?php
                    } else {
                    ?>
                        <p><a  class="to-report" href="index.php?action=reportTopicMessage&amp;idMessage=<?= $topic['tm_id']; ?>&amp;idTopic=<?= $topicId; ?> ">Signaler</a></p>
            <?php
                    }
                }
            }
            ?>
        </div>
        
    </div>
    <?php
    if (isset($_SESSION['pseudo'])) {
    ?>
    <div>
        <form class="form-tiny-mce" action="index.php?action=replyToMessage&amp;idForum=<?= $forumId ?>&amp;idTopic=<?= $topicId ?>" method="post" id="form-reply-to-message">

            <label for="reply-to-message">Laisser un message</label>
            <textarea id="reply-to-message" name="reply-to-message"></textarea>
            <span id="no-reply-to-message"></span>
                
            <input type="submit" value="Ajouter le message" />
         </form>
    </div>
    <?php
    } else {
    ?>
    <div>
        <p>Vous devez être connecté pour laisser un message</p>
        <p><a href="#" id="connect-to-reply">Se connecter</a></p>
    </div>
    <?php
    }
    ?>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>