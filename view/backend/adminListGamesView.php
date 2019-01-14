<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-all-games">
    
    <div id="admin-all-games-return">
        <p><a href="index.php?action=displayAdminHome"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <h1>Nos jeux</h1>
    </div>
    
    <div id="admin-add-topic">
        <p><a href="index.php?action=displayAdminCreateGame">Ajouter un jeu <i class="fas fa-arrow-right"></i></a></p>
    </div>

    <div id="admin-all-games-content">
        
        <?php
        $countgamess = $games->rowcount();
        if ($countgamess == 0) {
        ?>
        
            <div id="admin-no-list-games">
                <p>Aucun jeu</p>
            </div>

        <?php
        } else {   
            while ($game = $games->fetch()) {

                $GameExtract = $game['content'];
                
                $GameExtract = str_replace('<br />', ' ', $GameExtract);
                $GameExtract = strip_tags($GameExtract);
                $GameExtract = substr($GameExtract, 0, 200);
                $spacePosition = strrpos($GameExtract, " ");
                
                if ($spacePosition) {
                    $GameExtract = substr($GameExtract, 0, $spacePosition);
                }
        ?>
        
                <!-- Les données sont protégées par htmlspecialchars -->
                <div class="admin-game-content">
                    <h2><?= htmlspecialchars($game['title']) ?></h2>

                    <img src="images/games/<?= $game['image'] ?>" class="admin-image-game" alt="image du jeu"/> 

                    <p class="admin-game-extract"><?= $GameExtract ?> ...<a class="admin-modify-game" href="index.php?action=displayAdminModifyGame&amp;idGame=<?= $game['id']; ?>">Modifier ou supprimer</a>
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