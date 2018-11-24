<?php require_once('menuView.php'); ?>
<?php require_once('toLoginView.php'); ?>
<?php require_once('instantMessagesView.php'); ?>

<?php ob_start(); ?>

<section id="registration">

    <div>
        <h1>Inscription</h1>
    </div>

    <div id="registration-content">
        <form action="index.php?action=createAccount" method="post" id="form-registration">
            <p><em>Les champs obligatoires sont indiqués avec *</em></p>
            
            <p>
                <label for="pseudo">Pseudo*</label><br />
                <input type="text" id="pseudo" name="pseudo" required maxlength="20"/><span id="alert-pseudo"></span>
            </p>
            
            <p>
                <label for="email">Adresse Email*</label><br />
                <input type="email" id="email" name="email" required /><span id="alert-email"></span>
            </p>
            
            <p>
                <label for="password">Mot de passe*</label><br />
                <input type="password" id="password" name="password" minlength="8" required /><span id="alert-password">il faut au minimum 8 caractères</span>
            </p>
            
            <p>
                <label for="verif-password">Vérification du mot de passe*</label><br />
                <input type="Password" id="verif-password" name="verif-password" required /><span id="alert-verif-password"></span>
            </p>
            
            <p>
                <input type="submit" value="S'inscrire" />
            </p>
        </form>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>