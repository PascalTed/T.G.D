<?php require_once('view/frontend/menuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>
<?php require_once('view/frontend/instantMessagesView.php'); ?>

<?php ob_start(); ?>

<section id="home">

    <div>
        <h1>La team T.G.D vous souhaite la bienvenue</h1>
    </div>

    <div id="home-content">
        <div id="forums-games">
            <div id="nb-forums">
                <h2><i class="fas fa-comments"></i> Forums</h2>
                
                <?php
                if($nbForums['nb_forums']) {
                ?>
                
                    <p><a href="index.php?action=displayForums">Voir les <?= $nbForums['nb_forums'] ?> forums</a></p>
                
                <?php
                } else {
                ?>
                
                    <p>Aucun forum</p>
                
                <?php
                }
                ?>
                
            </div>
            
            <div id="nb-games">
                <h2><i class="fas fa-gamepad"></i> Nos jeux</h2>
                
                <?php
                if($nbGames['nb_games']) {
                ?>
                    <p><a href="index.php?action=displayListGames">Voir les <?= $nbGames['nb_games'] ?> jeux joués par la team</a></p>
                
                <?php
                } else {
                ?>
                
                    <p>Aucun jeu</p>
                <?php
                }
                ?>
                
            </div>
            
            <div id="tgd-players">
                <h2><i class="fab fa-teamspeak"></i> Team T.G.D</h2>
                <ul>
                    <li>Duncyx</li>
                    <li>Noupiii</li>
                    <li>Maniaco</li>
                    <li>GSXRLory</li>
                    <li>TEDVII</li>
                    <li>MATVIII</li>
                </ul>
            </div>
        </div>
        <?= $messages ?>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>