<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="all-games">
    
    <div id="games-return">
        <p><a href="index.php"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>

    <div>
        <h1>Nos jeux</h1>
    </div>

    <div id="all-games-content">
        
        <?php
        $countGames = $games->rowcount();
        if ($countGames == 0) {
        ?>
        
            <div id="no-list-games">
                <p>Aucun Jeu</p>
            </div>
                    
        <?php
        } else {
            while ($game = $games->fetch()) {

                $GameExtract = strip_tags($game['content']);
                $GameExtract = substr($GameExtract, 0, 200);
        ?>
                <div class="game-content">
                    <h2><?= $game['title'] ?></h2>

                    <img src="images/games/<?= $game['image'] ?>" class="image-game" alt="image du jeu"/> 

                    <p class="game-extract"><?= $GameExtract ?> ... <a class="read-more-game" href="index.php?action=displayGame&amp;idGame=<?= $game['id']; ?>"> <em>lire la suite</em></a>
                    </p>

                </div>

        <?php
            }
            $games->closeCursor();
        }
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>