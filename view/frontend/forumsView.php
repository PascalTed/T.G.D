<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="forums">

    <div id="forums-return">
        <p><a href="index.php"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <h1>Forums</h1>
    </div>
    
    <div id="forums-content">
        
        <?php
        $countForums = $forums->rowcount();
        if ($countForums == 0) {
        ?>
        
            <p id="no-list-forums">Aucun forum</p>
        
        <?php
        } else {
            while ($forum = $forums->fetch()) {
        ?>

                <div class="forum-categorie">
                    <div class="forum-cat-topics">
                        <div>
                            <h2><a href="index.php?action=displayForumTopics&amp;idForum=<?= $forum['id'] ?>&amp;catForum=<?= $forum['categories'] ?>"><?= $forum['categories'] ?></a>
                            </h2>
                        </div>

                        <p><strong><?= $forum['nb_topics'] ?> sujet(s)</strong></p>
                    </div>

                    <?php
                    if ($forum['nb_topics'] <= 0) {
                    ?>

                        <p>aucun message</p>

                    <?php
                    } else {
                    ?>
                        <!-- Les données sont protégées par htmlspecialchars -->
                        <p>dernier message par <?= htmlspecialchars($forum['pseudo']) ?> le <?= $forum['last_date'] ?></p>

                    <?php
                    }
                    ?>

                </div>

        <?php
            }
            $forums->closeCursor();
        }      
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>