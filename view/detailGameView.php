<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="game-detail">

    <div>
        <h1>Détail du jeu</h1>
    </div>

    <div id="game-content">
        <div id="game-header">
            <div>
                <h2>sql titre jeu</h2>
            </div>
            
            <div>
                <p>Genre : sql</p>
                <p>Date de sortie : sql</p>
            </div>
        </div>
        
        <div id="game-image-text">
            <p><image src="" />image sql</p>
            
            <div>
                <p>texte sql</p>
            </div>
        </div>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>