<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="skin/catalogue.css" />
</head>
<body>
    <nav class="menu">
        <ul>
            <?php
            foreach ($menu as $text => $link) {
                echo "<li><a href=\"$link\">$text</a></li>";
            }
            ?>
        </ul>
    </nav>
    <?php
    if (!isset($_SESSION['user'])) {
        echo "<form method='post' action=''>
                                <ul class='auth'>
                                    <li><label>Login : </label><input name='login' type='text'></li>
                                    <li><label>Mdp : </label><input name='mdp' type='password'></li>                             
                                    <li><input type='submit' value='Connexion'></form></li>                                    
                                </ul>";
    } else {
        echo "<form method='post' action=''>
                    <ul class='auth'>
                        <li><label>Bonjour, " . $_SESSION['user']["prenom"] . " " . $_SESSION['user']["nom"] . "</li>
                        <li><a href='?objet=catalogue&amp;action=show&amp;id=03'>Upload fichier</a></li>
                        <li><input name='deconnexion' type='submit' value='Deconnexion'></form></li>
                    </ul>";
        if (key_exists("deconnexion", $_POST)) {
            session_unset();
        }
    }
    ?>
    <main>
        <h1 class="titre_accueil"><?php echo $title; ?></h1>
        <?php echo $content;?>
    </main>
</body>
</html>

