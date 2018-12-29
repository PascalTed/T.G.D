<?php
namespace model\backend;

use model\frontend\Manager;

class AdminAccountManager extends Manager
{
    public function getAllAccounts()
    {
        $db = $this->dbConnect();
        $allAccounts = $db->query('SELECT id, avatar, pseudo, user_right, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin%ss\') registration_date FROM users');
        
        return $allAccounts;
    }
    
    public function getInfosAccount($userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, email, avatar, pseudo, user_right, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin%ss\') registration_date FROM users WHERE id = ?');
        $req->execute(array($userId));
        $infoAccount = $req->fetch();
   
        return $infoAccount;
    }
    
    public function setAdminRights($userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET user_right = \'admin\' WHERE id = ?');
        $req->execute(array($userId));
    }
    
    public function setNoneRights($userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET user_right = \'none\' WHERE id = ?');
        $req->execute(array($userId));
        
        if ($_SESSION['id'] == $userId) {
            $_SESSION['user_right'] = 'none';
        }
    }
}