<?php ob_start(); ?>

<div id="instant-messages">
    <h3>messages</h3>
    
    <div>

        <form action="index.php?action=addMessage" method="post" id="form-add-message">

            <?php 
            if (isset($_SESSION['pseudo'])) {
            ?>
                <label for="add-message">Laisser un message</label><br />
                <textarea type="text" id="add-message" name="add-message" rows="10" cols="30"></textarea><br />
                <span id="message-required"></span>
                <input type="submit" value="Envoyer" />

                <?php
                } else {
                ?>

                <p id="no-connected">Connectez-vous pour laisser un message.</p>
                <p><a href="#" id="messages-connect">Se connecter</a></p>

                <?php
                }
                ?>

        </form>
        
        <div id="all-messages">
            
        </div>
        
    </div>
</div>

<?php $messages = ob_get_clean(); ?>