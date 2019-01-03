<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>
<?php require_once('view/frontend/instantMessagesView.php'); ?>

<?php ob_start(); ?>

<section id="home">

    <div>
        <h1>La team T.G.D vous souhaite la bienvenue</h1>
    </div>

    <div id="home-content">
        <?= $messages ?>
        <div>
            <div id="nb-forums">
                <h2>Forums</h2>
                <p><a href="index.php?action=displayForums">Voir les <?= $nbForums['nb_forums'] ?> Forums</a></p>
            </div>
            
            <div id="nb-games">
                <h2>Nos jeux</h2>
                <p><a href="index.php?action=displayListGames">Voir les <?= $nbGames['nb_games'] ?> jeux joués par la team</a></p>
            </div>
        </div>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>