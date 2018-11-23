<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>
<?php require_once('instantMessagesView.php'); ?>

<?php ob_start(); ?>

<?= $messages ?>
<div id="home">
    <p>Accueil</p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>