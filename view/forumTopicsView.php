<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="forum">

    <div>
        <a href="index.php?action=displayForums">Forum</a><span>/</span><a href="#"><?= $catForum['categories'] ?></a>
    </div>
    
    <div>
        
        <?php
        if (isset($_SESSION['pseudo'])) {
        ?>
        
            <p><a href="#">Créer un sujet</a></p>
        
        <?php
        } else {
        ?>
        
            <p>Connectez-vous pour créer un nouveau sujet : <a href="">Se connecter</a></p>
        
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
                    <div><a href="index.php?action=displayTopic&amp;idTopic=<?= $topic['topicID'] ?>"><h4><?= $topic['title'] ?></h4></a></div>

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

<?php require('template.php'); ?>