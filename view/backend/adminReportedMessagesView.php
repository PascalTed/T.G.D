<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-reported-messages">
    
    <div>
        <h1>Les messages signalés</h1>
    </div>
    
    <div id="admin-reported-messages-content">
        
        <?php
        $countMessages = $reportedMessages->rowcount();
        if ($countMessages == 0) {
        ?>
        
            <div>
                <p>Aucun message signalé.</p>
            </div>
        
        <?php
        } else {
            while ($reportedMessage = $reportedMessages->fetch()) {
        ?>
                
            <div>
                    <p>Forum <?= $reportedMessage['forumCategorie'] ?></p>

                    <p>Topic <?= $reportedMessage['topicTitle'] ?></p>

                    <p>Message : <br /><?= $reportedMessage['tm_message'] ?></p>

                    <p><a href="index.php?action=validMessage&amp;idMessage=<?= $reportedMessage['tm_id'] ?>&amp;idTopic=<?= $reportedMessage['topicID'] ?>">Valider</a><a href="index.php?action=removeMessaget&amp;idMessage=<?= $reportedMessage['tm_id'] ?>">Supprimer</a>
                    </p>
            </div>
        
        <?php
            }
        }
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>