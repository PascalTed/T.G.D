<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="game-details">
    
    <div id="games-return">
        <!-- Les données sont protégées par htmlspecialchars -->
        <p><a href="index.php?action=displayListGames"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>

    <div>
        <!-- Les données sont protégées par htmlspecialchars -->
        <h1><?= htmlspecialchars($game['title']); ?></h1>
    </div>

    <div id="game-content">
        <div id="game-header">
            <p><strong>Genre : </strong><?= $game['type']; ?></p>
            <p><strong>Date de sortie : </strong><?= $game['release_date']; ?></p>
        </div>
        
        <div id="game-image-text">
            <image src="images/games/<?= $game['image']; ?>" alt="image du jeu" id="game-detail-image"/>
            
            <div>
                <p><?= $game['content']; ?></p>
            </div>
        </div>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>