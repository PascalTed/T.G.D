<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="all-games">

    <div>
        <h1>Nos jeux</h1>
    </div>

    <div class="all-games-content">

    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>