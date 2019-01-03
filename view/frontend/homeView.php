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
                <h2><a href="index.php?action=displayForums">Forums</a></h2>
            </div>
            
            <div id="nb-games">
                <h2><a href="index.php?action=displayListGames">Les jeux joués par la team</a></h2>
            </div>
        </div>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>