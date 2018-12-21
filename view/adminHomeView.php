<?php require_once('adminMenuView.php'); ?>
<?php require_once('toLoginView.php'); ?>
<?php require_once('instantMessagesView.php'); ?>

<?php ob_start(); ?>

<section id="admin-home">
    
    <div>
        <h1>Administration du site</h1>
    </div>
    
    <div id="admin-home-content">
        <div>
            <?= $messages ?>
            <p>Accueil</p>
        </div>

        <div>
            <ul>
                <li><i class="fas fa-cogs"></i>Forums
                    <ul>
                        <li><a href="index.php?action=displayAdminForums">Ajouter ou supprimer un forum</a></li>
                        <li><a href="">Supprimer un sujet</a></li>
                        <li><a href="">Supprimer un commentaire</a></li>
                    </ul>
                </li>

                <li><i class="fas fa-cogs"></i>Nos jeux
                    <ul>
                        <li><a href="">Ajouter ou supprimer un jeu</a></li>
                    </ul>
                </li>
                <li><i class="fas fa-cogs"></i>Compte
                    <ul>
                        <li><a href="">Modifier les droits utilisateur</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>