<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-all-games">
    
    <div>
        <h1>Editer Nos jeux</h1>
    </div>
    
    <div>
        <h2><a href="">Ajouter un jeu</a></h2>
    </div>

    <div id="admin-all-games-content">
        <h2>Listes des jeux à modifier</h2>
        <?php    
        while ($game = $games->fetch()) {
            
            $GameExtract = $game['content'];
            $GameExtract = substr($GameExtract, 0, 200);
            $spacePosition = strrpos($GameExtract, " ");
            if ($spacePosition) {
                $GameExtract = substr($GameExtract, 0, $spacePosition);
            }
        ?>
            
            <div class="admin-game-content">
                <h2><?= $game['title'] ?></h2>
                
                <img src="images/games/<?= $game['image'] ?>" class="admin-image-game" alt="image du jeu"/> 
                
                <!-- Toutes les données sont protégées par htmlspecialchars -->
                <p class="admin-game-extract"><?= strip_tags($GameExtract) ?>...<a class="admin-modify-game" href="index.php?action=displayGame&amp;idGame=<?= $game['id']; ?>">Modifier ou suprimer</a>
                </p>
                
            </div>
            
        <?php
        }
        ?>
        
    </div>

    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>