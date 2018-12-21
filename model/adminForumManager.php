<?php

require_once("model/Manager.php");

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
}

?>