<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="forums">

    <div>
        <h1 id="forums-title">Forums</h1>
    </div>
    
    <div id="forums-content">
        
        <?php    
        while ($forum = $forums->fetch()) {
        ?>
        
            <div class="forum-categorie">
                <div class="forum-cat-topics">
                    <div>
                       <h2><a href="index.php?action=displayForumTopics&amp;idForum=<?= $forum['id'] ?>&amp;catForum=<?= $forum['categories'] ?>"><?= $forum['categories'] ?></a>
                        </h2>
                    </div>

                    <div><?= $forum['nb_topics'] ?> sujets</div>
                </div>
                
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