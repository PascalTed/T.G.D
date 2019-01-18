<?php
namespace model\frontend;

abstract class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=tgd;charset=utf8', 'root', '');
        return $db;
    }
}

?>