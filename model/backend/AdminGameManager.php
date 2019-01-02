<?php
namespace model\backend;

use model\frontend\Manager;

class AdminGameManager extends Manager
{
    // Ajouter image jeu joué
    private function addFileGame($gameImage)
    {
        $extensions_valides = array('jpg' , 'jpeg' , 'png');
        
        //1. strrchr renvoie l'extension avec le point (« . »).
        //2. substr(chaine,1) ignore le premier caractère de chaine.
        //3. strtolower met l'extension en minuscules.
        $extension_upload = strtolower(substr(strrchr($gameImage['name'], '.'), 1));
        
        if (in_array($extension_upload,$extensions_valides)) {
            echo "Extension correcte";
            switch ($extension_upload) {
                case  'jpg':   
                case 'jpeg':
                    $newImage = imagecreatefromjpeg($gameImage['tmp_name']);
                    break;
                case 'png':
                    $newImage = imagecreatefrompng($gameImage['tmp_name']);
                    break;
            }      
    
            $DestinationFileAvatar = 'images/games/' . strtolower($gameImage['name']); 
        
            switch ($extension_upload) {
                case  'jpg':  
                case 'jpeg':
                    $resultat = imagejpeg($newImage, $DestinationFileAvatar);
                    break;
                case 'png':
                    $resultat = imagepng($newImage, $DestinationFileAvatar);
                    break;
            } 
            if ($resultat) {
                echo 'Transfert réussi';
                return strtolower($gameImage['name']);
            }else {
                echo 'Erreur lors du transfert';
            }
            var_dump($resultat);
            imagedestroy($newImage);

        } else {
            echo 'Extension incorrecte'; 
        }
    }
    
    // Enregistrer le jeu joué
    public function addGame($userId, $gameImage, $gameTitle, $gameReleaseDate, $gameType, $gameContent)
    {
        $fileGameName = $this->addFileGame($gameImage);
        
        $db = $this->dbConnect();
        
        $req = $db->prepare('INSERT INTO played_games (user_id, title, image, content, type, release_date, creation_date) VALUES (?, ?, ?, ?, ?, ?, NOW())');
        
        $req->execute(array($userId, $gameTitle, $fileGameName, $gameContent, $gameType, $gameReleaseDate));
    }
    
    // Modifié un jeu joué
    public function ediGame($userId, $gameImage, $gameTitle, $gameReleaseDate, $gameType, $gameContent)
    {
        $fileGameName = $this->addFileGame($gameImage);
        
        $db = $this->dbConnect();
        
        $req = $db->prepare('UPDATE played_games SET user_id = ?, title = ?, image = ?, content = ?, type = ?, release_date = ?) VALUES (?, ?, ?, ?, ?, ?');
        
        $req->execute(array($userId, $gameTitle, $fileGameName, $gameContent, $gameType, $gameReleaseDate));
    }
}