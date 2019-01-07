<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="forum">

    <div id="forum-return">
        <!-- Les données sont protégées par htmlspecialchars -->
        <p><a href="index.php?action=displayForums"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <!-- Les données sont protégées par htmlspecialchars -->
        <h1>Forum <?= htmlspecialchars($forumCat) ?></h1>
    </div>
    
    <div id="new-topics">

        <?php
        if (isset($_SESSION['pseudo'])) {
        ?>

            <p><a href="index.php?action=displayCreateTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>">Ajouter un sujet</a></p>

        <?php
        } else {
        ?>

            <p>Connectez-vous pour créer un nouveau sujet : <a href="#" id="connect-to-forum">Se connecter</a></p>

        <?php
        }
        ?>

    </div>
    
    <div id="forum-content">

        <?php
        $countTopics = $topics->rowcount();
        if ($countTopics == 0) {
        ?>

            <p id="none-topics">Aucun sujet de créé</p>

        <?php
        } else {
            while ($topic = $topics->fetch()) {
        ?>
                <div class="topics">
                    <h2>
                        <!-- Les données sont protégées par htmlspecialchars -->
                        <a href="index.php?action=displayTopic&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>&amp;idTopic=<?= $topic['topicID'] ?>"><?= htmlspecialchars($topic['title']) ?> (<?= $topic['nb_message'] ?> messages)</a>
                    </h2>
              
                    <p>Posté par <?= htmlspecialchars($topic['t_pseudo']) ?> le <?= $topic['creation_date'] ?></p>

                    <p>Dernier message par <?= htmlspecialchars($topic['tm_pseudo']) ?> le <?= $topic['last_date'] ?></p>
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