<?php ob_start(); ?>

<div id="instant-messages">
        
    <?php 
    if (isset($_SESSION['pseudo'])) {
    ?>
    
        <form action="index.php?action=addMessage" method="post" id="form-add-message">           
            <label for="add-message"><i class="far fa-comment"></i> Laisser un message</label><br />
            <textarea type="text" id="add-message" name="add-message"></textarea>
            <p id="message-required">Le champ message n'est pas rempli.</p>
            <input type="submit" value="Envoyer" />
        </form>
        
    <?php
    } else {
    ?>

        <div id="no-connected">
            <p id="no-connected-message"><strong>Connectez-vous pour laisser un message.</strong></p>
            <p><a href="#" id="connect-to-message">Se connecter</a></p>
        </div>
        
    <?php
    }
    ?>
        
    <div id="all-messages">
        <p id ="none-instant-message">Aucun message</p>
        
        <?php    
        while ($message = $messages->fetch()) {
        ?>
            
            <div id="message-<?= $message['id'] ?>" class="message">
                <img src="images/avatars/<?= $message['avatar'] ?>" class="mini-image-avatar" alt="mini image avatar"/> 
                <!-- Les données sont protégées par htmlspecialchars -->
                <p class="message-pseudo"><strong><?= htmlspecialchars($message['pseudo']) ?></strong></p>
                <p class="message-date"><em>le <?= $message['message_date_fr'] ?></em></p>
                <p><?= nl2br(htmlspecialchars($message['message'])) ?></p>
            </div>
            
        <?php
        }
        $messages->closeCursor();
        ?>
            
    </div>
</div>


<?php $messages = ob_get_clean(); ?>