<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-home">
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>