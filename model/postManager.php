<?php

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getlistPostsGames()
    {
        $db = $this->dbConnect();
        $games = $db->query('SELECT id, title, image, content FROM played_games ORDER BY creation_date DESC');
        
        return $games;
    }
}