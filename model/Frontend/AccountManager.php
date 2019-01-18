<?php
namespace model\frontend;

use model\Manager;

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
        $account = $db->prepare('INSERT INTO users (pseudo, pass, email, registration_date) VALUES (?, ?, ?, NOW())');
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
    
    // changer avatar
    public function changeAvatar($imageAvatar, $userId)
    {
        $extensions_valides = array('jpg' , 'jpeg' , 'png', 'gif');
        
        //1. strrchr renvoie l'extension avec le point (« . »).
        //2. substr(chaine,1) ignore le premier caractère de chaine.
        //3. strtolower met l'extension en minuscules.
        $extension_upload = strtolower(substr(strrchr($imageAvatar['name'], '.'), 1));
        
        if ( in_array($extension_upload,$extensions_valides) ) {

            switch ($extension_upload) {
                case  'jpg':   
                case 'jpeg':
                    $newImage = imagecreatefromjpeg($imageAvatar['tmp_name']);
                    break;
                case 'png':
                    $newImage = imagecreatefrompng($imageAvatar['tmp_name']);
                    break;
                case 'gif':
                    $newImage = imagecreatefromgif($imageAvatar['tmp_name']);
                    break;
            }      

            $crop_width = imagesx($newImage);
            $crop_height = imagesy($newImage);
                
            $size = min($crop_width, $crop_height);
                        
            if($crop_width >= $crop_height) {
                $newx= ($crop_width-$crop_height)/2;
                $croppedImage = imagecrop($newImage, ['x' => $newx, 'y' => 0, 'width' => $size, 'height' => $size]);
            }
            else {
                $newy= ($crop_height-$crop_width)/2;
                $croppedImage = imagecrop($newImage, ['x' => 0, 'y' => $newy, 'width' => $size, 'height' => $size]);
            }
            
            $DestinationFileAvatar = 'images/avatars/' . $userId . '.' .$extension_upload; 
        
            switch ($extension_upload) {
                case  'jpg':  
                case 'jpeg':
                    $resultat = imagejpeg($croppedImage,$DestinationFileAvatar);
                    break;
                case 'png':
                    $resultat = imagepng($croppedImage,$DestinationFileAvatar);
                    break;
                case 'gif':
                    $resultat = imagegif($croppedImage,$DestinationFileAvatar);
                    break;
            } 
            if (!$resultat) {
                return 'Erreur lors du transfert';
            }

            imagedestroy($newImage);
            
            $this->addNameFileAvatar($userId . '.' .$extension_upload, $userId);
            
            $_SESSION['avatar'] = $userId . '.' .$extension_upload;

        } else {
            return 'Extension incorrecte';
        }
    }
    
    // Enregistrer le nom du nouveau fichier image avatar
    private function addNameFileAvatar($NameFileAvatar, $userId)
    {
        $db = $this->dbConnect();
        $avatar = $db->prepare('UPDATE users SET avatar = ? where id = ?');
        $avatar->execute(array($NameFileAvatar, $userId));
    }
    
    // Se déconnecter
    public function removeSession()
    {
        // Suppression des variables de session et de la session
        $_SESSION = array();
        session_destroy();
    }
}

?>