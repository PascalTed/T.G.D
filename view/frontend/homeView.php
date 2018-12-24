<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>
<?php require_once('instantMessagesView.php'); ?>

<?php ob_start(); ?>

<section id="home">

    <div>
        <h1>La team T.G.D vous souhaite la bienvenue</h1>
    </div>

    <div id="home-content">
        <?= $messages ?>
        <p>Accueil</p>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>