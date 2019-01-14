<!DOCTYPE html>

<html lang="fr">
    
    <head>
        <meta charset="utf-8" />
        <title>Forum de la team T.G.D</title>
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="fontawesome/css/all.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="La team T.G.D (The Good Death) vous souhaite la bienvenue sur son forum">
        
        <!-- Facebook, Open Graph data -->
		<meta property="og:title" content="Forum de la team T.G.D">
		<meta property="og:type" content="website">
		<meta property="og:url" content="http://tgd.tedsev.com/">
		<meta property="og:image" content="http://tgd.tedsev.com/images/tgd.PNG">
		<meta property="og:description" content="La team T.G.D (The Good Death) vous souhaite la bienvenue sur son forum, on y parle de jeux pc, hardware, et software">
        
        <!-- Twitter Card data -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="http://tgd.tedsev.com/">
		<meta name="twitter:title" content="Forum de la team T.G.D">
		<meta name="twitter:description" content="La team T.G.D (The Good Death) vous souhaite la bienvenue sur son forum, on y parle de jeux pc, hardware, et software">
		<meta name="twitter:image" content="http://tgd.tedsev.com/images/tgd.PNG">
    </head>
    
    <body>
        <div id="body-block">
            <header>
                <div id="header-title">
                    <div id="header-burger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <p>T.G.D<br /><span>The Good Death</span></p>
                </div>
                <?= $menu ?>
                <!-- début connexion -->
                <div id="opaque-window"></div>
                <?= $connection ?>
                <!-- fin connexion -->
            </header>

            <!-- <section> -->
            <?= $content ?>
            <!-- </section> -->
            
            <footer>
                <div>
                    <div id="social-icons">
                        <p><a href="https://www.facebook.com/"><img src="images/social/facebook.png" alt="facebook"/></a></p>
                        <p><a href="https://twitter.com/"><img src="images/social/twitter.png" alt="twitter"/></a></p>
                    </div>
                    <div id="copyright">
                        <p><a target="_blank" href="http://the-good-death.copyright01.com/">Copyright © 2019 tgd.tedsev.com</a></p>
                    </div>
                </div>
            </footer>
        </div>
        <!-- début script -->
        <script src="js/tinymce/tinymce.js"></script>
        <script>
            tinymce.init({
            selector: '#create-content-topic, #reply-to-message, #content-game, #edit-content-game', menubar: false, toolbar: 'undo redo | emoticons | bold | italic | underline | strikethrough | forecolor | alignleft aligncenter alignright alignjustify | link', branding: false, statusbar: false, entity_encoding: "raw", plugins: "link emoticons textcolor", language: 'fr_FR', default_link_target: "_blank", target_list: false, link_title: false, anchor_top: false, anchor_bottom: false, forced_root_block: false, min_height: 150
            });
        </script>
        <script src="js/regex.js"></script>
        <script src="js/ajaxget.js"></script>
        <script src="js/ajaxpost.js"></script>
        <script src="js/appli.js"></script>
        <!-- fin script -->
    </body>

</html>