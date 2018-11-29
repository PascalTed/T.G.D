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
    
    // Obtenir tous les messages
    public function getMessage()
    {
        $db = $this->dbConnect();
        
        $messages = $db->query('SELECT messages.id, messages.user_id, messages.message, DATE_FORMAT(messages.message_date, \'%d/%m/%Y à %Hh%imin%ss\') AS message_date_fr, users.pseudo FROM messages INNER JOIN users ON messages.user_id = users.id ORDER BY messages.id DESC LIMIT 0, 25');

        return $messages;
    }
    
    // Obtenir les derniers messages
    public function getLastMessage($messageId)
    {
        $db = $this->dbConnect();
        
        $messages = $db->prepare('SELECT messages.id, messages.user_id, messages.message, DATE_FORMAT(messages.message_date, \'%d/%m/%Y à %Hh%imin%ss\') AS message_date_fr, users.pseudo FROM messages INNER JOIN users ON messages.user_id = users.id AND messages.id > ? ORDER BY messages.id DESC');
        $req->execute(array($messageId));
        
        return $messages;
    }
}

?>