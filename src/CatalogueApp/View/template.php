<!DOCTYPE html>
<html lang="fr" xmlns:og="http://ogp.me/ns#">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="src/skin/catalogue.css"/>
    <script src='src/js/upload.js' defer></script>
    <?php echo $meta; ?>
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

