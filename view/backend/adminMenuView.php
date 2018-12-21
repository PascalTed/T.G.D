<?php ob_start(); ?>

<nav id="header-menu">
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="index.php?action=displayAdminHome"><i class="fas fa-cogs"></i> Administrer</a></li>
        
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