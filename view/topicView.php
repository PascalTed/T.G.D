<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="Topic">

    <div>
        <a href="index.php?action=displayForums">Forum</a><span>/</span><a href="index.php?action=displayForumTopics&amp;idForum=<?= $forumTopics['id'] ?>&amp;catForum=<?= $forumTopics['categories'] ?>"><?= $forumTopics['categories'] ?></a><span>/</span><a href="#"><?= $forumTopics['title'] ?></a>
    </div>
    
    <div>
        
        <?php    
        while ($topic = $topicMessages->fetch()) {
        ?>
            
            <div>

                <div><p>posté par <?= $topic['pseudo'] ?></p></div>

                <div>message par <?= $topic['message'] ?>></div>
            </div>
        
        <?php
        }
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>