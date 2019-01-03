<?php
namespace model\frontend;

use model\frontend\Manager;

class GameManager extends Manager
{
    public function getListGames()
    {
        $db = $this->dbConnect();
        $games = $db->query('SELECT id, title, image, content FROM played_games ORDER BY creation_date DESC');
        
        return $games;
    }
    
    public function getGame($gameId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, image, content, type, release_date FROM played_games WHERE id = ? ORDER BY creation_date DESC');
        $req->execute(array($gameId));
        $game = $req->fetch();
        
        return $game;
    }
    
    public function getNbGames()
    {
        $db = $this->dbConnect();
        $nbGames = $db->query('SELECT COUNT(id) nb_games FROM played_games');
        return $nbGames;
    }
}