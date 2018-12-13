<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="topic">

    <div>
        <a href="index.php?action=displayForums">Forum</a><span>/</span><a href="index.php?action=displayForumTopics&amp;idForum=<?= $infoForumTopic['forum_id'] ?>&amp;catForum=<?= $infoForumTopic['forum_cat'] ?>"><?= $infoForumTopic['forum_cat'] ?></a><span>/</span><a href="#"><?= $infoForumTopic['topic_title'] ?></a>
    </div>
    
    <div>
        <div>
            <div>
                <div>
                    <img src="images/avatars/<?= $infoForumTopic['avatar'] ?>" />
                    <p>Inscrit le <?= $infoForumTopic['user_date'] ?></p>
                </div>
            </div>
            <div>
                <p>Le <?= $infoForumTopic['topic_date'] ?></p>
                <p><?= $infoForumTopic['message'] ?></p>
            </div>
        </div>
        
        <?php    
        while ($topic = $topicMessages->fetch()) {
        ?>
            
            <div>

                <div><p>posté par <?= $topic['pseudo'] ?></p></div>

                <div>message  <?= $topic['message'] ?></div>
                <div>Date du message : <?= $topic['message_date'] ?></div>
            </div>
        
        <?php
        }
        ?>
        
    </div>
    <?php
    if (isset($_SESSION['pseudo'])) {
    ?>
    <div>
        <form class="form-tiny-mce" action="index.php?action=createTopic&amp;idForum=<?= $infoForumTopic['forum_id'] ?>&amp;idTopic=$infoForumTopic['topic_id']" method="post" id="form-create-topic">

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
        <p><a href="">Se connecter</a></p>
    </div>
    <?php
    }
    ?>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>