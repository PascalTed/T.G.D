<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-Forum">
    
    <div>
        <a href="index.php?action=displayAdminForums">Forum</a><span>/</span><a href="#"><?= $forumCat ?></a>
    </div>
    
    <div>
        
        <?php
        $countTopics = $topics->rowcount();
        if ($countTopics == 0) {
        ?>
        
            <div>
                <p>Aucun sujet de créé.</p>
            </div>
        
        <?php
        } else {
            while ($topic = $topics->fetch()) {
        ?>
        
                <div>
                    <div><a href="index.php?action=displayAdminTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>&amp;idTopic=<?= $topic['topicID'] ?>"><h4><?= $topic['title'] ?></h4></a></div>

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