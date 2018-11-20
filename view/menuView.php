<?php ob_start(); ?>

<nav id="header-menu">
    <ul>
        <li><a href="#">Accueil</a></li>
        <li><a href="#">Forum</a></li>
        <li><a href="#">Nos jeux</a></li>
        <li><a href="#">Bons plans</a></li>
        
        <?php
        if (isset($_SESSION['pseudo'])) {
        ?>

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