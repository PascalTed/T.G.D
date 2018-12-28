<?php
namespace model\backend;

use model\frontend\Manager;

class AdminForumManager extends Manager
{
    public function editForumCat($userId, $forumCat)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('INSERT INTO forums (user_id, categories) VALUES (?, ?)');
        $req->execute(array($userId, $forumCat));
    }
    
    public function updateForumCat($userId, $forumCat, $forumId)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('UPDATE forums SET user_id = ?, categories = ? WHERE id = ?');
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
        $req = $db->query('SELECT topics_messages.id tm_id, topics_messages.message tm_message, topics_messages.message_date tm_date, topics.id topicID, topics.title topicTitle, topics.creation_date topicCreation_date, forums.id forumID, forums.categories forumCategorie FROM topics_messages INNER JOIN topics ON topics_messages.topic_id = topics.id INNER JOIN forums ON topics.forum_id = forums.id WHERE topics_messages.moderation = 1 ORDER BY tm_id DESC');
        
        $reportedMessages = $req->fetch();
        return $reportedMessages;
    }
}

?>