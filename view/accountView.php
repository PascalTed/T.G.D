<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>
<?php require_once('instantMessagesView.php'); ?>

<?php ob_start(); ?>

<section id="account">
    
    <div>
        <h1>Mon compte</h1>
    </div>
    
    <div id="account-content">

        <p>Mon compte</p>

    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>