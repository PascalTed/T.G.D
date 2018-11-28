<?php

require_once("model/Manager.php");

class MessageManager extends Manager
{
    // Enregistrer le message
    public function editMessage($userId, $instantMessage)
    {
        $db = $this->dbConnect();
        
        $message = $db->prepare('INSERT INTO messages(user_id, message, message_date) VALUES(?, ?, NOW())');
        $message->execute(array($userId, $instantMessage));
    }
}

?>
        