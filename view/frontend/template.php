<!DOCTYPE html>

<html lang="fr">
    
    <head>
        <meta charset="utf-8" />
        <title></title>
        <link rel="icon" type="image/png" href="">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="fontawesome/css/all.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="">
        
        <!-- Facebook, Open Graph data -->
		<meta property="og:title" content="">
		<meta property="og:type" content="website">
		<meta property="og:url" content="">
		<meta property="og:image" content="">
		<meta property="og:description" content="">
        
        <!-- Twitter Card data -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="">
		<meta name="twitter:title" content="">
		<meta name="twitter:description" content="">
		<meta name="twitter:image" content="">
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
            </footer>
        </div>
        <!-- début script -->
        <script src="js/tinymce/tinymce.js"></script>
        <script>
            tinymce.init({
            selector: '#create-title-topic, #title-game, #release-date-game, #type-game', menubar: false, toolbar: 'undo redo', branding: false, statusbar: false, entity_encoding: "raw", plugins: "autoresize", forced_root_block: false
            });
            tinymce.init({
            selector: '#create-content-topic, #reply-to-message, #content-game', menubar: false, toolbar: 'undo redo | emoticons | bold | italic | underline | strikethrough | forecolor | alignleft aligncenter alignright alignjustify | link', branding: false, statusbar: false, entity_encoding: "raw", plugins: "autoresize link emoticons textcolor", language: 'fr_FR', default_link_target: "_blank", target_list: false, link_title: false, anchor_top: false, anchor_bottom: false
            });
        </script>
        <script src="js/regex.js"></script>
        <script src="js/ajaxget.js"></script>
        <script src="js/ajaxpost.js"></script>
        <script src="js/appli.js"></script>
        <!-- fin script -->
    </body>

</html>