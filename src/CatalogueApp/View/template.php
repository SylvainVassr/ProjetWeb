<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="src/skin/catalogue.css" />
</head>
<body>
    <div class="contenu-page">
        <h1 class="titre_accueil"><?php echo $title; ?></h1>
        <nav class="menu">
            <ul>
                <?php
                foreach ($menu as $text => $link) {
                    echo "<li><div class='position'>
                                <div class='svg-wrapper'>
                                    <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                    <rect id='shape' height='40' width='150' />
                                    <div id='text'>
                                        <a href=\"$link\"><span class='spot'></span>$text</a>
                                    </div>
                                    </svg>
                                </div>
                              </div>
                            </li>";
                }
                ?>
            </ul>
        </nav>
        <?php echo $auth; ?>
        <main>
            <?php echo $content; ?>
        </main>
    </div>
    <footer>
        © Sébastien AGNEZ et Sylvain VASSEUR. All Rights Reserved.
    </footer>
</body>
</html>

