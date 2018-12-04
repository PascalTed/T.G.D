<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="game-details">

    <div>
        <h1>Détails du jeu</h1>
    </div>

    <div class="game-content">
        <div class="game-header">
            <div>
                <h2>sql titre jeu</h2>
            </div>
            
            <div>
                <p>Genre : sql</p>
                <p>Date de sortie : sql</p>
            </div>
        </div>
        
        <div class="game-image-text">
            <p><image src="" />image sql</p>
            
            <div>
                <p>texte sql</p>
            </div>
        </div>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>