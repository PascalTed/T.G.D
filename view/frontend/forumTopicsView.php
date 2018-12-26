<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="forum">

    <div>
        <a href="index.php?action=displayForums">Forum</a><span>/</span><a href="#"><?= $forumCat ?></a>
    </div>
    
    <div>
        
        <?php
        if (isset($_SESSION['pseudo'])) {
        ?>
        
            <p><a href="index.php?action=displayCreateTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>">Créer un sujet</a></p>
        
        <?php
        } else {
        ?>
        
            <p>Connectez-vous pour créer un nouveau sujet : <a href="#" id="connect-to-forum">Se connecter</a></p>
        
        <?php
        }
        ?>
        
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
                    <div>
                        <h4>
                            <a href="index.php?action=displayTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>&amp;idTopic=<?= $topic['topicID'] ?>"><?= $topic['title'] ?> <?= $topic['nb_message'] ?> messages</a>
                        </h4>
                    </div>

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