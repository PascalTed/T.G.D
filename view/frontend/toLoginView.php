<?php ob_start(); ?>               

<div id="login-window">
    <form action="#" method="post" id="form-login-window">
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
        
        <p id="pseudo-pass-alert">Pseudo ou mot de passe incorrect</p>
        
        <p>
            <input type="submit" value="Se connecter" id="submit-login-window"/>
        </p>
                
        <p>
            <a href="index.php?action=displayCreateAccount">Pas encore de compte ? Inscrivez-vous !</a>
        </p>
        
    </form>
</div>

<?php $connection = ob_get_clean(); ?>