<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-reported-messages">
    
    <div id="admin-reported-messages-return">
        <p><a href="index.php?action=displayAdminHome"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <h1>Messages signalés</h1>
    </div>
    
    <div id="admin-reported-messages-content">
        
        <?php
        $countMessages = $reportedMessages->rowcount();
        if ($countMessages == 0) {
        ?>
        
            <div id="none-reported-message">
                <p>Aucun messages signalés</p>
            </div>
        
        <?php
        } else {
            while ($reportedMessage = $reportedMessages->fetch()) {
        ?>
                
                <div class="verif-message-reported">
                    <div class="reported-message-info">
                        <p><strong>Forum : </strong><?= htmlspecialchars($reportedMessage['forumCategorie']) ?></p>
                        <!-- Les données sont protégées par htmlspecialchars -->
                        <p><strong>Sujet : </strong><?= htmlspecialchars($reportedMessage['topicTitle']) ?> <em>le <?= htmlspecialchars($reportedMessage['topicCreation_date']) ?></em></p>
                        
                        <!-- Les données sont protégées par htmlspecialchars -->
                        <p><strong>Message : </strong>par <?= htmlspecialchars($reportedMessage['tm_pseudo']) ?> <em>le <?=$reportedMessage['tm_date'] ?></em></p>
                        <p>"<?= $reportedMessage['tm_message'] ?>"</p>
                    </div>

                    <div class="validate-delete-message"><a href="index.php?action=validMessage&amp;idMessage=<?= $reportedMessage['tm_id'] ?>" class="validate-message">Valider</a><a href="index.php?action=removeMessage&amp;idMessage=<?= $reportedMessage['tm_id'] ?>&amp;idTopic=<?= $reportedMessage['topicID'] ?>" class="delete-message">Supprimer</a>
                    </div>
                </div>
        
        <?php
            }
            $reportedMessages->closeCursor();
        }
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>