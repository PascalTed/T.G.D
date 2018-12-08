<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="forums">

    <div>
        <a href="">Forums</a>
    </div>
    
    <div>
        
        <?php    
        while ($forum = $forums->fetch()) {
        ?>
        
            <div>
                <div>
                    <div>
                        <img src="" />
                    </div>
                    
                    <div>
                        <a href="index.php?action=displayForumTopics&amp;idForum=<?= $forum['id'] ?>&amp;catForum=<?= $forum['categories'] ?>">
                            <h4><?= $forum['categories'] ?></h4>
                        </a>
                    </div>
                </div>

                <div><?= $forum['nb_topics'] ?> sujets</div>
                
                <?php
                if ($forum['nb_topics'] <= 0) {
                ?>
                
                    <div>Pas de messages</div>
                
                <?php
                } else {
                ?>
                
                    <div>dernier message par <?= $forum['pseudo'] ?> le <?= $forum['last_date'] ?></div>
                
                <?php
                }
                ?>

            </div>
        
        <?php
        }
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>