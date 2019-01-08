<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="topic">

    <div id="topic-return">
        <!-- Les données sont protégées par htmlspecialchars -->
        <p><a href="index.php?action=displayForumTopics&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <!-- Les données sont protégées par htmlspecialchars -->
        <h1>Sujet <?= htmlspecialchars($infoTopic['topicTitle']) ?></h1>
    </div>
    
    <?php
    if (!isset($_SESSION['pseudo'])) {
    ?>
    
        <div class="connect-to-report-reply">
            <p>Vous devez être connecté pour signaler ou laisser un message</p>
        </div>
    
    <?php
    }
    ?>
                                                                                 
    <div id="topic-content">
                    
        <?php    
        while ($topic = $topicMessages->fetch()) {
        ?>
            <!-- Les données sont protégées par htmlspecialchars -->
            <div class="all-messages-topic">
                <div class="info-user">
                    <p><img src="images/avatars/<?= $topic['avatar'] ?>" alt="image avatar" class="topic-image-avatar" /></p>
                    <p><strong><?= htmlspecialchars($topic['pseudo']) ?></strong></p>
                    <p>Inscrit le <?= $topic['registration_date'] ?></p>
                </div>

                <div class="info-message">
                    <p><em><strong>le <?= $topic['message_date'] ?></strong></em></p>  
                    <div><?= $topic['message'] ?></div>

                    <?php
                    if (isset($_SESSION['pseudo'])) {
                        if ($topic['moderation'] == 1) {
                    ?>

                            <p class="already-report">Message signalé</p>

                        <?php
                        } else {
                        ?>
                            <p><a  class="to-report" href="index.php?action=reportTopicMessage&amp;idMessage=<?= $topic['tm_id']; ?>&amp;idTopic=<?= $topicId; ?> ">Signaler</a></p>

                    <?php
                        }
                    }
                    ?>

                </div>
            </div>
            
        <?php
        }
        $topicMessages->closeCursor();
        ?>
        
    </div>
    
    <?php
    if (isset($_SESSION['pseudo'])) {
    ?>
    
        <div>
            <form class="form-tiny-mce" action="index.php?action=replyToMessage&amp;idForum=<?= $forumId ?>&amp;idTopic=<?= $topicId ?>" method="post" id="form-reply-to-message">

                <label for="reply-to-message"><strong>Laisser un message</strong></label>
                <textarea id="reply-to-message" name="reply-to-message"></textarea>
                <span id="no-reply-to-message">Le champ message est vide</span>

                <input type="submit" value="Ajouter le message" />
             </form>
        </div>
    
    <?php
    } else {
    ?>
    
        <div class="connect-to-report-reply">
            <p>Vous devez être connecté pour signaler ou laisser un message : <a href="#" id="connect-to-reply">Se connecter</a></p>
        </div>
    
    <?php
    }
    ?>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>