<?php ob_start(); ?>

<div id="instant-messages">
    <h3>messages</h3>
    
    <div id="form-all-messages">
        <form action="index.php?action=addMessage" method="post" id="form-add-message">

            <?php 
            if (isset($_SESSION['pseudo'])) {
            ?>
            
                <label for="add-message">Laisser un message</label><br />
                <textarea type="text" id="add-message" name="add-message" rows="10" cols="30"></textarea><br />
                <span id="message-required"></span>
                <input type="submit" value="Envoyer" />
        </form>
            
            <?php
            } else {
            ?>
        
                <p id="no-connected">Connectez-vous pour laisser un message.</p>
                <p><a href="#" id="messages-connect">Se connecter</a></p>

            <?php
            }
            ?>
        <div id="all-messages">
        
            <?php    
            while ($message = $messages->fetch()) {
            ?>
                <div id="<?= $message['id'] ?>" class="message">
                    <!-- Affichage de chaque message (toutes les données sont protégées par htmlspecialchars -->
                    <p><strong><?= htmlspecialchars($message['pseudo']) ?></strong><em> le <?= $message['message_date_fr'] ?></em></p>
                
                    <p>"<?= nl2br(htmlspecialchars($message['message'])) ?>"</p>
                </div>
            <?php
            }
            $messages->closeCursor();
            ?>
            
         </div>
    </div>
</div>

<?php $messages = ob_get_clean(); ?>