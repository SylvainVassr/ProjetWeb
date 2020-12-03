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
    <?php
    if (!isset($_SESSION['user'])) {
        echo "<form method='post' action=''>
                                <ul class='auth'>
                                    <li><div class='barre_auth'><label>Login : </label><input name='login' type='text'></div></li>
                                    <li><div class='barre_auth'><label>Mdp : </label><input name='mdp' type='password'></div></li>                             
                                    <li><div class='position'>
                                            <div class='svg-wrapper'>
                                                <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                                <rect id='shape' height='40' width='150' />
                                                <div id='text'>
                                                    <input type='submit' value='Connexion'>  
                                                </div>
                                                </svg>
                                            </div>
                                        </div>
                                   </form></li>                                    
                                </ul>";
    } else {
        echo "<form method='post' action=''>
                    <ul class='auth'>
                        <li><div class='barre_auth'><label>Bonjour, " . $_SESSION['user']["prenom"] . " " . $_SESSION['user']["nom"] . "</label></div></li>
                        <li><div class='position'>
                            <div class='svg-wrapper'>
                                <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                <rect id='shape' height='40' width='150' />
                                <div id='text'>
                                    <a href='?objet=upload&amp;action=show&amp;'><span class='spot'></span>Upload fichier</a>
                                </div>
                                </svg>
                            </div>
                          </div></li>
                        <li><div class='position'>
                                            <div class='svg-wrapper'>
                                                <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                                <rect id='shape' height='40' width='150' />
                                                <div id='text'> 
                                                    <input name='deconnexion' type='submit' value='Déconnexion'>                                                  
                                                </div>
                                                </svg>
                                            </div>
                                        </div></form></li>
                    </ul>";
        if (key_exists("deconnexion", $_POST)) {
            session_unset();
            header("Location: index.php");
        }
    }
    ?>
    <main>
        <h1 class="titre_accueil"><?php echo $title; ?></h1>
        <?php echo $content; ?>
    </main>
</body>
</html>

