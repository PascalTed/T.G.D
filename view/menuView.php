<?php ob_start(); ?>

<nav id="header-menu">
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="index.php?action=displayForums">Forum</a></li>
        <li><a href="index.php?action=displayListGames">Nos jeux</a></li>
        
        <?php
        if (isset($_SESSION['pseudo'])) {
        ?>
            
            <li><a href="index.php?action=displayAccount" id="display-account">Mon compte</a></li>
            
            <?php
            if (isset($_SESSION['user_right']) && $_SESSION['user_right'] == "admin") {
            ?>
        
                <li><a href="index.php?action=displayAdminHome">Gérer</a></li>
            
            <?php
            }
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