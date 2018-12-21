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
}

?>