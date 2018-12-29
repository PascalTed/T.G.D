<?php
namespace model\backend;

use model\frontend\Manager;

class AdminAccountManager extends Manager
{
    public function getAllAccounts()
    {
        $db = $this->dbConnect();
        $allAccounts = $db->query('SELECT id, pseudo, user_right, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin%ss\') registration_date FROM users');
        
        return $allAccounts;
    }
}