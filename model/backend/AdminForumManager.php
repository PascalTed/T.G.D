<?php
namespace model\backend;

use model\Manager;

class AdminForumManager extends Manager
{
    public function editForumCat($userId, $forumCat)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('INSERT INTO forums (user_id, categories, edition_date) VALUES (?, ?, NOW())');
        $req->execute(array($userId, $forumCat));
    }
    
    public function updateForumCat($userId, $forumCat, $forumId)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('UPDATE forums SET user_id = ?, categories = ?, edition_date = NOW() WHERE id = ?');
        $req->execute(array($userId, $forumCat, $forumId));
    }
    
    public function deleteForumCat($forumId)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('DELETE FROM forums WHERE id = ?');
        $req->execute(array($forumId));
    }
    
    public function deleteTopicsOfForum($forumId)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('DELETE FROM topics WHERE forum_id = ?');
        $req->execute(array($forumId));
    }
    
    public function deleteMessagesOfForum($forumId)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('DELETE FROM topics_messages WHERE forum_id = ?');
        $req->execute(array($forumId));
    }
    
    public function searchForumCat($forumCat)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT id FROM forums WHERE categories = ?');
        $req->execute(array($forumCat));
        $existingForumCat = $req->fetch();
        
        if ($existingForumCat['id']) {
            echo "existForum";
        }
    }
    
    public function updateTopic($userId, $titleTopic, $topicId)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('UPDATE topics SET user_id_update = ?, title = ?, update_date = NOW() WHERE id = ?');
        $req->execute(array($userId, $titleTopic, $topicId));
    }
    
    public function deleteTopic($topicId)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('DELETE FROM topics WHERE id = ?');
        $req->execute(array($topicId));
    }
    
    public function deleteMessagesOfTopic($topicId)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('DELETE FROM topics_messages WHERE topic_id = ?');
        $req->execute(array($topicId));
    }
    
    // Supprimer le message d'un topic (administration)
    // Si celuic-ci est le premier message du topic, le topic et tous ses messages seront supprimés 
    public function deleteMessage($messageId, $topicId)
    {
        $db = $this->dbConnect();
        $delMessage = $db->prepare('DELETE FROM topics_messages WHERE id = ?');
        $delMessage->execute(array($messageId));
        
        $delTopic = $db->prepare('DELETE FROM topics WHERE topic_message_id = ?');
        $delTopic->execute(array($messageId));
        
        if ($delTopic->rowCount() > 0) {
            $this->deleteMessagesOfTopic($topicId);
        }
    }
    
    public function getReportedMessages()
    {
        $db = $this->dbConnect();
        $reportedMessages = $db->query('SELECT topics_messages.id tm_id, topics_messages.message tm_message, DATE_FORMAT(topics_messages.message_date, \'%d/%m/%Y à %Hh%imin%ss\') tm_date, topics.id topicID, topics.title topicTitle, DATE_FORMAT(topics.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') topicCreation_date, forums.id forumID, forums.categories forumCategorie, pseudo tm_pseudo FROM topics_messages INNER JOIN topics ON topics_messages.topic_id = topics.id INNER JOIN forums ON topics.forum_id = forums.id INNER JOIN users ON topics_messages.user_id = users.id WHERE topics_messages.moderation = 1 ORDER BY tm_id DESC');

        return $reportedMessages;
    }
    
    // Valider le message signalé d'un topic (administration)
    public function validateMessage($messageId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE topics_messages SET moderation = false WHERE id = ?');
        $req->execute(array($messageId));
    }
}

?>