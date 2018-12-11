<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="topic">

    <div>
        <a href="index.php?action=displayForums">Forum</a><span>/</span><a href="index.php?action=displayForumTopics&amp;idForum=<?= $forumTopics['forum_id'] ?>&amp;catForum=<?= $forumTopics['forum_cat'] ?>"><?= $forumTopics['forum_cat'] ?></a><span>/</span><a href="#"><?= $forumTopics['topic_title'] ?></a>
    </div>
    
    <div>
        <div>
            <div>
                <div>
                    <img src="images/avatars/<?= $forumTopics['avatar'] ?>" />
                    <p>Inscrit le <?= $forumTopics['user_date'] ?></p>
                </div>
            </div>
            <div>
                <p>Le <?= $forumTopics['topic_date'] ?></p>
                <p><?= $forumTopics['topic_content'] ?></p>
            </div>
        </div>
        
        <?php    
        while ($topic = $topicMessages->fetch()) {
        ?>
            
            <div>

                <div><p>posté par <?= $topic['pseudo'] ?></p></div>

                <div>message par <?= $topic['message'] ?></div>
            </div>
        
        <?php
        }
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>