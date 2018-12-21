<?php

require_once("model/Manager.php");

class AdminForumManager extends Manager
{
    public function editForumCat($userID, $forumCat)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('INSERT INTO forums (user_id, categories) VALUES (?, ?)');
        $req->execute(array($userID, $forumCat));
    }
}

?>