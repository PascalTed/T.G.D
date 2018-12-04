<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="all-games">

    <div>
        <h1>Nos jeux</h1>
    </div>

    <div class="all-games-content">
        
        <?php    
        while ($game = $games->fetch()) {
            
            $GameExtract = $game['content'];
            $GameExtract = substr($GameExtract, 0, 200);
            $spacePosition = strrpos($GameExtract, " ");
            if ($spacePosition) {
                $GameExtract = substr($GameExtract, 0, $spacePosition);
            }
        ?>
            
            <div class="game-content">
                <h2><?= $game['title'] ?></h2>
                
                <img src="images/games/<?= $game['image'] ?>" class="image-game" alt="image du jeu"/> 
                
                <!-- Toutes les données sont protégées par htmlspecialchars -->
                <p class="game-extract"><?= strip_tags($GameExtract) ?><a class="read-more-game" href="index.php?action=postGame&amp;idGame=<?= $game['id']; ?>"> <em>... lire la suite</em></a>
                </p>
                
            </div>
            
        <?php
        }
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>