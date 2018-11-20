<?php ob_start(); ?>               

<div id="login-window">
    <form action="#" method="post">
        <i class="fas fa-times fa-2x" id="close-window-login"></i>
        <p>
            <label for="pseudo-connect">Pseudo : </label><br />
            <input type="text" id="pseudo-connect" name="pseudo-connect" />
        </p>
        <p>
            <label for="password-connect">Mot de passe : </label><br />
            <input type="password" id="password-connect" name="password-connect" />
        </p>
        
        <p id="pseudo-pass-alert"></p>
        
        <p>
            <input type="submit" value="Se connecter"/>
        </p>
                
        <p>
            <a href="">Pas encore de compte ? Inscrivez-vous !</a>
        </p>
        
    </form>
</div>

<?php $connection = ob_get_clean(); ?>