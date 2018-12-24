<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="game-details">

    <div>
        <h1>Détails du jeu</h1>
    </div>

    <div class="game-content">
        <div class="game-header">
            <div>
                <h2><?= $game['title']; ?></h2>
            </div>
            
            <div>
                <p>Genre : <?= $game['type']; ?></p>
                <p>Date de sortie : <?= $game['release_date']; ?></p>
            </div>
        </div>
        
        <div class="game-image-text">
            <p><image src="images/games/<?= $game['image']; ?>" /></p>
            
            <div>
                <p><?= $game['content']; ?></p>
            </div>
        </div>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>