<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="game-details">

    <div>
        <h1><?= $game['title']; ?></h1>
    </div>

    <div id="game-content">
        <div id="game-header">
            <p><span>Genre : </span><?= $game['type']; ?></p>
            <p><span>Date de sortie : </span><?= $game['release_date']; ?></p>
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