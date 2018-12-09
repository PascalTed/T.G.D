<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="forum">

    <div>
        <a href="index.php?action=displayForums">Forum</a><span>/</span><a href="#"><?= $titleForum ?></a>
    </div>
    
    <div>
        
        <?php    
        while ($topic = $topics->fetch()) {
        ?>
            
            <div>
                <div><a href="index.php?action=displayTopic&amp;idTopic=<?= $topic['topicID'] ?>&amp;titleTopic=<?= $topic['title'] ?>"><h4><?= $topic['title'] ?></h4></a></div>

                <div><p>posté par <?= $topic['t_pseudo'] ?> le <?= $topic['creation_date'] ?></p></div>

                <div>dernier message par <?= $topic['tm_pseudo'] ?> le <?= $topic['last_date'] ?></div>
            </div>
        
        <?php
        }
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>