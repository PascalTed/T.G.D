<?php

require_once("model/Manager.php");

class PostManager extends Manager
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
    
    public function getForums()
    {
        $db = $this->dbConnect();
        
        $forums = $db->query('SELECT id, categories, nb_topics, pseudo, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin%ss\') last_date FROM (SELECT forums.id, forums.categories, COUNT(topics.forum_id) nb_topics FROM forums LEFT JOIN topics ON forums.id = topics.forum_id GROUP BY forums.categories) table_a LEFT JOIN (SELECT topics_messages.forum_id, MAX(topics_messages.message_date) date, users.pseudo FROM topics_messages INNER JOIN users ON topics_messages.user_id = users.id GROUP BY topics_messages.forum_id) table_b ON table_a.id = table_b.forum_id ORDER BY nb_topics DESC'); 
        
        return $forums;
    }
     
    public function getTopics($forumId)
    {
        $db = $this->dbConnect();
        
        $topics = $db->prepare('SELECT topicID, messageID, title, nb_message, t_pseudo, creation_date, tm_pseudo, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin%ss\') last_date FROM (SELECT topics.id topicID, COUNT(topics_messages.topic_id) nb_message, topics.title, users.pseudo t_pseudo, DATE_FORMAT(topics.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') creation_date FROM topics INNER JOIN users ON users.id = topics.user_id INNER JOIN topics_messages ON topics_messages.topic_id = topics.id WHERE topics.forum_id = ? GROUP BY topicID) t1 INNER JOIN (SELECT topics_messages.id messageID, topics_messages.topic_id, users.pseudo tm_pseudo, MAX(topics_messages.message_date) date FROM topics_messages INNER JOIN users ON topics_messages.user_id = users.id GROUP BY topics_messages.topic_id) t2 ON t1.topicID = t2.topic_id'); 
        $topics->execute(array($forumId));
        
        return $topics;
    }
    
    public function getTopicMessages($topicId)
    {
        $db = $this->dbConnect();
        $topicMessages = $db->prepare('SELECT topics_messages.id tm_id, message, moderation, message_date, pseudo, avatar FROM topics_messages INNER JOIN users ON users.id = topics_messages.user_id WHERE topics_messages.topic_id = 15 AND topics_messages.id > (SELECT MIN(topics_messages.id) FROM topics_messages WHERE topics_messages.topic_id = 15) order by topics_messages.id ASC');
        
        $topicMessages->execute(array($topicId));
        return $topicMessages;
    }
    
    public function getForumIdCat($forumId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, categories FROM forums WHERE id = ?');
        
        $req->execute(array($forumId));
        $forumIdCat = $req->fetch();
        return $forumIdCat;
    }
    
    public function getForumTopics($topicId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT forums.id forum_id, forums.categories forum_cat, topics.id topic_id, topics.title topic_title, message, DATE_FORMAT(topics.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') topic_date, users.pseudo, users.avatar, DATE_FORMAT(users.registration_date, \'%d/%m/%Y à %Hh%imin%ss\') user_date FROM forums INNER JOIN topics ON forums.id = topics.forum_id INNER JOIN users ON topics.user_id = users.id INNER JOIN (SELECT topics_messages.topic_id, topics_messages.message FROM topics_messages WHERE topics_messages.topic_id = ? HAVING MIN(topics_messages.id)) t1 ON t1.topic_id = topics.id');
        
        $req->execute(array($topicId));
        $forumTopics = $req->fetch();
        return $forumTopics;
    }
}