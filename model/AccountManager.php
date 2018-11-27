<?php

require_once("model/Manager.php");

class AccountManager extends Manager
{
    
     // Début vérification des informations saisies (pseudo et email), venant d'un ajaxpost, avant de créer un compte.
    public function searchPseudo($pseudo) 
    {
        $db = $this->dbConnect();
        
        $pseudoAccount = $db->prepare('SELECT id, pseudo, email FROM users WHERE pseudo = ?');
        $pseudoAccount->execute(array($pseudo));
        $existingUser = $pseudoAccount->fetch();

        if ($existingUser['pseudo']) {
            echo "existUser";
        }
    }
    
    public function searchMail($mail) 
    {
        $db = $this->dbConnect();
        
        $mailAccount = $db->prepare('SELECT id, pseudo, email FROM users WHERE email = ?');
        $mailAccount->execute(array($mail));
        $existingMail = $mailAccount->fetch();

        if ($existingMail['email']) {
            echo "existEmail";
        }
    }
    // Fin vérification des informations saisies (pseudo et email), venant d'un ajaxpost, avant de créer un compte.
    
    // Création du compte
    public function editAccount($pseudo, $mail, $pass)
    {
        $passHash = password_hash($pass, PASSWORD_DEFAULT);
        $db = $this->dbConnect();
        $account = $db->prepare('INSERT INTO users (pseudo, pass, email) VALUES (?, ?, ?)');
        $account->execute(array($pseudo, $passHash, $mail));
        
        $sessionAccount = $db->prepare('SELECT id, email, avatar, user_right FROM users WHERE pseudo = ?');
        $sessionAccount->execute(array($pseudo));
        $infosSession = $sessionAccount->fetch();
        
        $_SESSION['id'] = $infosSession['id'];
        $_SESSION['avatar'] = $infosSession['avatar'];
        $_SESSION['user_right'] = $infosSession['user_right'];
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['email'] = $infosSession['email'];
    }
    
    // Vérification des informations saisies (pseudo et pass), venant d'un ajaxpost, avant de se connecter
    public function searchPseudoPass($pseudo, $pass) 
    {
        $db = $this->dbConnect();
        $account = $db->prepare('SELECT id, pass, email, avatar, user_right FROM users WHERE pseudo = ?');
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
            $_SESSION['email'] = $existingUsers['email'];
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