<?php

require_once("model/Manager.php");

class AccountManager extends Manager
{
    
    // Création du compte
    public function editAccount($pseudo, $mail, $pass)
    {
        $passHash = password_hash($pass, PASSWORD_DEFAULT);
        $db = $this->dbConnect();
        $account = $db->prepare('INSERT INTO users (pseudo, pass, email) VALUES (?, ?, ?)');
        $account->execute(array($pseudo, $passHash, $mail));
        
        $sessionAccount = $db->prepare('SELECT id, avatar, user_right FROM users WHERE pseudo = ?');
        $sessionAccount->execute(array($pseudo));
        $infosSession = $sessionAccount->fetch();
        
        $_SESSION['id'] = $existingUsers['id'];
        $_SESSION['avatar'] = $existingUsers['avatar'];
        $_SESSION['user_right'] = $existingUsers['user_right'];
        $_SESSION['pseudo'] = $pseudo;  
    }
    
    // Vérification des informations saisies (pseudo et pass), venant d'un ajaxpost, avant de se connecter
    public function searchPseudoPass($pseudo, $pass) 
    {
        $db = $this->dbConnect();
        $account = $db->prepare('SELECT id, pass, avatar, user_right FROM users WHERE pseudo = ?');
        $account->execute(array($pseudo));
        $existingUsers = $account->fetch();
            
        $passHashVerif = password_verify($pass, $existingUsers['pass']);
            
        if (!$existingUsers) {
            echo "noUser";
        } elseif ($passHashVerif) {

            $_SESSION['id'] = $existingUsers['id'];
            $_SESSION['avatar'] = $existingUsers['avatar'];
            $_SESSION['user_right'] = $existingUsers['user_right'];
            $_SESSION['pseudo'] = $pseudo;           
            echo 'valid';
            
        } else {
            echo "noPass";
        } 
    }
    // Se déconnecter
    public function removeSession()
    {
        // Suppression des variables de session et de la session
        $_SESSION = array();
        session_destroy();
    }
}