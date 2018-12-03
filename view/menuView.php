<?php ob_start(); ?>

<nav id="header-menu">
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="#">Forum</a></li>
        <li><a href="index.php?action=displayOurGames">Nos jeux</a></li>
        <li><a href="#">Bons plans</a></li>
        
        <?php
        if (isset($_SESSION['pseudo'])) {
        ?>
            
            <li><a href="index.php?action=displayAccount" id="display-account">Mon compte</a></li>
            <li><a href="index.php?action=logoutAccount" id="logout">Se déconnecter</a></li>

        <?php
        } else {
        ?>

            <li><a href="#" id="header-menu-connect">Connexion</a></li>

        <?php
        }
        ?>
        
    </ul>
</nav>

<?php $menu = ob_get_clean(); ?>