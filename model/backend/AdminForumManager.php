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
}

?>