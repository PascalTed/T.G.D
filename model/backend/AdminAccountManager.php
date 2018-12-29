<?php
namespace model\backend;

use model\frontend\Manager;

class AdminAccountManager extends Manager
{
    public function getAllAccounts()
    {
        $db = $this->dbConnect();
        $allAccounts = $db->query('SELECT * FROM users');
        
        return $allAccounts;
    }
}