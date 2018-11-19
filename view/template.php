<?php require('menuView.php') ?>

<!DOCTYPE html>

<html lang="fr">
    
    <head>
        <meta charset="utf-8" />
        <title></title>
        <link rel="icon" type="image/png" href="">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">

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
            </header>
            
            <div>
                <h1>La team des T.G.D vous souhaite la bienvenue</h1>
            </div>
            
            <section>
                <?= $messages ?>
            </section>
            
            <div>test</div>
            
            <footer>
            </footer>
        </div>
        <!-- début script -->
        <script src="js/appli.js"></script>
        <!-- fin script -->
    </body>

</html>