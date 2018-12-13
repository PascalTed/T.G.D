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
        
        $forums = $db->query('SELECT id, categories, nb_topics, pseudo, DATE_FORMAT(message_date, \'%d/%m/%Y à %Hh%imin%ss\') last_date FROM (SELECT forums.id, forums.categories, COUNT(topics.forum_id) nb_topics FROM forums LEFT JOIN topics ON forums.id = topics.forum_id GROUP BY forums.categories) table_a LEFT JOIN (SELECT forum_id, message_date, users.pseudo FROM (SELECT tm.* FROM topics_messages tm INNER JOIN (SELECT forum_id, MAX(id) AS maxId FROM topics_messages GROUP BY forum_id) t1 ON tm.forum_id = t1.forum_id AND tm.id = t1.maxId) t2 INNER JOIN users ON users.id = t2.user_id) table_b ON table_a.id = table_b.forum_id ORDER BY nb_topics DESC'); 
        
        return $forums;
    }
     
    public function getTopics($forumId)
    {
        $db = $this->dbConnect();
        
        $topics = $db->prepare('SELECT topicID, messageID, title, nb_message, t_pseudo, creation_date, tm_pseudo, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin%ss\') last_date FROM (SELECT topics.id topicID, COUNT(topics_messages.topic_id) nb_message, topics.title, users.pseudo t_pseudo, topics.creation_date FROM topics INNER JOIN users ON users.id = topics.user_id INNER JOIN topics_messages ON topics_messages.topic_id = topics.id WHERE topics.forum_id = ? GROUP BY topicID) table_a INNER JOIN (SELECT t2.id messageID, topic_id, users.pseudo tm_pseudo, message_date date FROM (SELECT tm.* FROM topics_messages tm INNER JOIN (SELECT topic_id, MAX(id) AS maxId FROM topics_messages GROUP BY topic_id) t1 ON tm.topic_id = t1.topic_id AND tm.id = t1.maxId) t2 INNER JOIN users ON users.id = t2.user_id) table_b ON table_a.topicID = table_b.topic_id ORDER BY topicID DESC'); 
        $topics->execute(array($forumId));
        
        return $topics;
    }
    
    public function getTopicMessages($topicId)
    {
        $db = $this->dbConnect();
        $topicMessages = $db->prepare('SELECT topics_messages.id tm_id, message, moderation, DATE_FORMAT(message_date, \'%d/%m/%Y à %Hh%imin%ss\') message_date, pseudo, avatar FROM topics_messages INNER JOIN users ON users.id = topics_messages.user_id WHERE topics_messages.topic_id = ? AND topics_messages.id > (SELECT topics_messages.id FROM topics_messages WHERE topics_messages.topic_id = ? ORDER BY topics_messages.id ASC LIMIT 1) ORDER BY topics_messages.id ASC');
        
        $topicMessages->execute(array($topicId, $topicId));
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
    
    public function getInfoForumTopic($topicId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT forums.id forumID, forums.categories forumCat, topics.id topicID, topics.title topicTitle, message, moderation, DATE_FORMAT(topics.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') topicDate, users.pseudo, users.avatar, DATE_FORMAT(users.registration_date, \'%d/%m/%Y à %Hh%imin%ss\') userDate FROM forums INNER JOIN topics ON forums.id = topics.forum_id INNER JOIN users ON topics.user_id = users.id INNER JOIN (SELECT topics_messages.topic_id, topics_messages.message, topics_messages.moderation FROM topics_messages WHERE topics_messages.topic_id = ? ORDER BY topics_messages.id ASC LIMIT 1) t1 ON t1.topic_id = topics.id');
        
        $req->execute(array($topicId));
        $forumTopics = $req->fetch();
        return $forumTopics;
    }
    
    public function editTopic($userId, $forumId, $titleTopic, $firstMessageTopic)
    {
        $db = $this->dbConnect();
        $editNewTopic = $db->prepare('INSERT INTO topics(title, user_id, forum_id, creation_date) VALUES (?, ?, ?, NOW())');
        
        $editNewTopic->execute(array($titleTopic, $userId, $forumId));
        
        $lastTopicId = $db->lastInsertId();
        echo $lastTopicId;

        $db = $this->dbConnect();
        $editFirstMessage = $db->prepare('INSERT INTO topics_messages (user_id, forum_id, topic_id, message, message_date) VALUES (?, ?, ?, ?, NOW())');
        
        $editFirstMessage->execute(array($userId, $forumId, $lastTopicId, $firstMessageTopic));
    }
}