<?php
namespace model\frontend;

use model\frontend\Manager;

class InstantMessageManager extends Manager
{
    // Enregistrer le message
    public function editMessage($userId, $instantMessage)
    {
        $db = $this->dbConnect();
        
        $message = $db->prepare('INSERT INTO instant_messages(user_id, message, message_date) VALUES(?, ?, NOW())');
        $message->execute(array($userId, $instantMessage));
    }
    
    // Obtenir tous les messages
    public function getMessage()
    {
        $db = $this->dbConnect();
        
        $messages = $db->query('SELECT instant_messages.id, instant_messages.user_id, instant_messages.message, DATE_FORMAT(instant_messages.message_date, \'%d/%m/%Y à %Hh%imin%ss\') AS message_date_fr, users.pseudo, users.avatar FROM instant_messages INNER JOIN users ON instant_messages.user_id = users.id ORDER BY instant_messages.id DESC LIMIT 0, 100');

        return $messages;
    }
    
    // Obtenir les derniers messages
    public function getLastMessage($messageId)
    {
        $db = $this->dbConnect();
        
        $messages = $db->prepare('SELECT instant_messages.id, instant_messages.user_id, instant_messages.message, DATE_FORMAT(instant_messages.message_date, \'%d/%m/%Y à %Hh%imin%ss\') AS message_date_fr, users.pseudo, users.avatar FROM instant_messages INNER JOIN users ON instant_messages.user_id = users.id AND instant_messages.id > ? ORDER BY instant_messages.id DESC');
        $messages->execute(array($messageId));
        
        return $messages;
    }
}

?>