<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="forum">

    <div id="forum-return">
        <p><a href="index.php?action=displayForums"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <h1>Forum <?= strip_tags($forumCat) ?></h1>
    </div>
    
    <div id="new-topics">

        <?php
        if (isset($_SESSION['pseudo'])) {
        ?>

            <p id="user-add-new-topics"><a href="index.php?action=displayCreateTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>">Ajouter un sujet <i class="fas fa-arrow-right"></i></a></p>

        <?php
        } else {
        ?>

            <p id="connect-add-topic">Connectez-vous pour créer un nouveau sujet : <a href="#">Se connecter</a></p>

        <?php
        }
        ?>

    </div>
    
    <div id="forum-content">

        <?php
        $countTopics = $topics->rowcount();
        if ($countTopics == 0) {
        ?>

            <p id="none-topics">Aucun sujet</p>

        <?php
        } else {
            while ($topic = $topics->fetch()) {
        ?>
                <div class="topics">
                    <h2>
                        <a href="index.php?action=displayTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>&amp;idTopic=<?= $topic['topicID'] ?>"><?= strip_tags($topic['title']) ?></a>
                    </h2>
                    
                    <div>
                        <!-- Les données sont protégées par htmlspecialchars -->
                        <p>posté par <?= htmlspecialchars($topic['t_pseudo']) ?> le <?= $topic['creation_date'] ?></p>
                        <p><strong><?= $topic['nb_message'] ?> messages</strong></p>
                        <p>dernier message par <?= htmlspecialchars($topic['tm_pseudo']) ?> le <?= $topic['last_date'] ?></p>
                    </div>
                </div>

        <?php
            }
            $topics->closeCursor();
        }
        ?>
  
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>