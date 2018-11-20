<?php

require_once("model/Manager.php");

class AccountManager extends Manager
{
    // Vérification des informations saisies (pseudo et pass), venant d'un ajaxpost, avant de se connecter
    public function searchPseudoPass($pseudo, $pass) 
    {
        $db = $this->dbConnect();
        $account = $db->prepare('SELECT id, pass, avatar, admin, moderator FROM users WHERE pseudo = ?');
        $account->execute(array($pseudo));
        $existingUsers = $account->fetch();
            
        $passHashVerif = password_verify($pass, $existingUsers['pass']);
            
        if (!$existingUsers) {
            echo "noUser";
        } elseif ($passHashVerif) {

            $_SESSION['id'] = $existingUsers['id'];
            $_SESSION['avatar'] = $existingUsers['avatar'];
            $_SESSION['admin'] = $existingUsers['admin'];
            $_SESSION['moderator'] = $existingUsers['moderator'];
            $_SESSION['pseudo'] = $pseudo;           
            echo 'valid';
            
        } else {
            echo "noPass";
        } 
    }
}