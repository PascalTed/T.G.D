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
    
    public function getPostGame($gameId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, image, content, type, release_date FROM played_games WHERE id = ? ORDER BY creation_date DESC');
        $req->execute(array($gameId));
        $game = $req->fetch();
        
        return $game;
    }
    
       public function getForums()
   {
        $db = $this->dbConnect();
        
        // liste des forums | nombre de sujets par forum | date des derniers messages avec pseudos
        $forums = $db->query('SELECT id, categories, nb_topics, pseudo, last_date FROM (SELECT forums.id, forums.categories, COUNT(forums.categories) nb_topics FROM forums INNER JOIN topics ON forums.id = topics.forum_id GROUP BY forums.categories) table_a INNER JOIN (SELECT topics_messages.forum_id, MAX(topics_messages.message_date) last_date, users.pseudo FROM topics_messages INNER JOIN users ON topics_messages.user_id = users.id GROUP BY topics_messages.forum_id) table_b ON table_a.id = table_b.forum_id'); 
        
        Return $forums;
        
     }
    
}