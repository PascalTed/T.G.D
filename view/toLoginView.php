<?php ob_start(); ?>               

<div id="login-window">
    <form action="#" method="post">
        <!-- icon fontawesome -->
        <i class="fas fa-skull-crossbones fa-2x" id="close-login-window"></i>
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
            <input type="submit" value="Se connecter" id="submit-login-window"/>
        </p>
                
        <p>
            <a href="">Pas encore de compte ? Inscrivez-vous !</a>
        </p>
        
    </form>
</div>

<?php $connection = ob_get_clean(); ?>