<?php ob_start(); ?>

<nav id="header-menu">
    <ul>
        <li><a href="#">Accueil</a></li>
        <li><a href="#">Forum</a></li>
        <li><a href="#">Nos jeux</a></li>
        <li><a href="#">Bons plans</a></li>
        <li><a href="#">Connexion</a></li>
    </ul>
</nav>

<?php $menu = ob_get_clean(); ?>