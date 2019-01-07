<?php
namespace model\frontend;

use model\frontend\Manager;

class ForumManager extends Manager
{
    public function getForums()
    {
        $db = $this->dbConnect();
        
        $forums = $db->query('SELECT id, categories, nb_topics, pseudo, DATE_FORMAT(message_date, \'%d/%m/%Y à %Hh%imin%ss\') last_date FROM (SELECT forums.id, forums.categories, COUNT(topics.forum_id) nb_topics FROM forums LEFT JOIN topics ON forums.id = topics.forum_id GROUP BY forums.categories) table_a LEFT JOIN (SELECT forum_id, message_date, users.pseudo FROM (SELECT tm.* FROM topics_messages tm INNER JOIN (SELECT forum_id, MAX(id) AS maxId FROM topics_messages GROUP BY forum_id) t1 ON tm.forum_id = t1.forum_id AND tm.id = t1.maxId) t2 INNER JOIN users ON users.id = t2.user_id) table_b ON table_a.id = table_b.forum_id ORDER BY nb_topics DESC'); 
        
        return $forums;
    }
    
    public function getNbForums()
    {
        $db = $this->dbConnect();
        
        $req = $db->query('SELECT COUNT(id) nb_forums FROM forums');
        $nbForums = $req->fetch();
        
        return $nbForums;
    }
     
    public function getTopics($forumId)
    {
        $db = $this->dbConnect();
        
        $topics = $db->prepare('SELECT topicID, messageID, title, nb_message, t_pseudo, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') creation_date, tm_pseudo, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin%ss\') last_date FROM (SELECT topics.id topicID, COUNT(topics_messages.topic_id) nb_message, topics.title, users.pseudo t_pseudo, topics.creation_date FROM topics INNER JOIN users ON users.id = topics.user_id INNER JOIN topics_messages ON topics_messages.topic_id = topics.id WHERE topics.forum_id = ? GROUP BY topicID) table_a INNER JOIN (SELECT t2.id messageID, topic_id, users.pseudo tm_pseudo, message_date date FROM (SELECT tm.* FROM topics_messages tm INNER JOIN (SELECT topic_id, MAX(id) AS maxId FROM topics_messages GROUP BY topic_id) t1 ON tm.topic_id = t1.topic_id AND tm.id = t1.maxId) t2 INNER JOIN users ON users.id = t2.user_id) table_b ON table_a.topicID = table_b.topic_id ORDER BY topicID DESC'); 
        $topics->execute(array($forumId));
        
        return $topics;
    }
    
    public function getTopicMessages($topicId)
    {
        $db = $this->dbConnect();
        $topicMessages = $db->prepare('SELECT topics_messages.id tm_id, message, moderation, DATE_FORMAT(message_date, \'%d/%m/%Y à %Hh%imin%ss\') message_date, pseudo, avatar, DATE_FORMAT(registration_date, \'%d/%m/%Y\') registration_date FROM topics_messages INNER JOIN users ON users.id = topics_messages.user_id WHERE topics_messages.topic_id = ? ORDER BY topics_messages.id ASC');
        
        $topicMessages->execute(array($topicId));
        return $topicMessages;
    }
    
    public function getInfoTopic($topicId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT topics.title topicTitle, DATE_FORMAT(topics.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') topicDate FROM topics WHERE topics.id = ?');
        
        $req->execute(array($topicId));
        $forumTopics = $req->fetch();
        return $forumTopics;
    }
    
    public function searchTopic($titleTopic)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id FROM topics WHERE title = ?');
        $req->execute(array($titleTopic));
        
        $existingTopic = $req->fetch();
        if ($existingTopic['id']) {
            echo "existTopic";
        }
    }
    
    // Enregistrement du nouveau topic et de son premier message
    public function editTopic($userId, $forumId, $titleTopic, $firstMessageTopic)
    {
        $db = $this->dbConnect();
        $editNewTopic = $db->prepare('INSERT INTO topics(title, user_id, forum_id, creation_date, user_id_update, update_date) VALUES (?, ?, ?, NOW(), ?, NOW())');
        
        $editNewTopic->execute(array($titleTopic, $userId, $forumId, $userId));
        
        $lastTopicId = $db->lastInsertId();
        echo $lastTopicId;
        
        $this->editMessage($userId, $firstMessageTopic, $forumId, $lastTopicId);
        
        $req = $db->prepare('SELECT * FROM topics_messages WHERE topic_id = ?');
        $req->execute(array($lastTopicId));
        $newTopicMessage = $req->fetch();
        
        $upNewTopic = $db->prepare('UPDATE topics SET topic_message_id = ? where id = ?');
        $upNewTopic->execute(array($newTopicMessage['id'], $lastTopicId));
    }
    
    // Enregistrer le message d'un topic
    public function editMessage($userId, $message, $forumId, $topicId)
    {
        $db = $this->dbConnect();
        $editNewMessage = $db->prepare('INSERT INTO topics_messages (user_id, forum_id, topic_id, message, message_date) VALUES (?, ?, ?, ?, NOW())');
        
        $editNewMessage->execute(array($userId, $forumId, $topicId, $message));
    }
    
    // Signaler le message d'un topic
    public function editReport($messageId)
    {
        $db = $this->dbConnect();
        $message =  $db->prepare('UPDATE topics_messages SET moderation = true WHERE id = ?');
        $message->execute(array($messageId));
    }
}