<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="src/skin/catalogue.css" />
</head>
<body>
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
                          </div>";
            }
            ?>
        </ul>
    </nav>
    <?php echo $auth; ?>

    <main>
        <h1 class="titre_accueil"><?php echo $title; ?></h1>
        <?php echo $content; ?>
    </main>
</body>
</html>

