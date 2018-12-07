<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="forums">

    <div>
        <h1>Forums</h1>
    </div>
    
    <div>
        
        <?php    
        while ($forum = $forums->fetch()) {
        ?>
            
            <div>
                <div>
                    <div>image</div>
                    <div><a href="#"><h4><?= $forum['categories'] ?></h4></a></div>
                </div>

                <div><?= $forum['nb_topics'] ?> sujet(s)</div>

                <div>dernier message par <?= $forum['pseudo'] ?> le <?= $forum['last_date'] ?></div>
            </div>
        
        <?php
        }
        ?>
        
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>