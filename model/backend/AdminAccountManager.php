<?php
namespace model\backend;

use model\frontend\Manager;

class AdminAccountManager extends Manager
{
    public function getAllAccounts()
    {
        $db = $this->dbConnect();
        $allAccounts = $db->prepare('SELECT * FROM users');
        
        return $allAccounts;
    }
}