<?php
    session_start();
    require_once './API/API.php';

    if(isset($_SESSION['user'])){
        header('Location: ./admin.php');
        exit();
    }

    if(isset($_POST['submit'])) {
        $database = new Database();
        $userHandler = new UserHandler($database);
        $userHandler->createUser($_POST['lastname'], $_POST['firstname'], $_POST['mail'], $_POST['password'], $_POST['password_validation']);
    }
?>

<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="../image/heartbeat-solid.svg" type="image/x-icon">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
    </head>

    <body>

        <main>
            <h2>Inscription</h2>

            <form class="form-box" action="" method="post">
                <input type="text" name="firstname" placeholder="Prénom" required/>
                <input type="text" name="lastname" placeholder="Nom" required/>
                <input type="email" name="mail" placeholder="E-mail" required/>
                <input type="password" name="password" placeholder="Mot de passe" minlength="4" maxlength="16" required/>
                <input type="password" name="password_validation" placeholder="Confirmez le mot de passe" minlength="4" maxlength="16" required/>
                <?php
                    if(isset($_GET['err'])){
                        extract($_GET);

                        switch($err){
                            case 'password':
                                echo '<div id="error"><p>'.htmlspecialchars('Mot de passe différent').'</p></div>';
                                break;
                            case 'email':
                                echo '<div id="error"><p>'.htmlspecialchars('Adresse mail incorrecte').'</p></div>';
                                break;

                            case 'email_length':
                                echo '<div id="error"><p>'.htmlspecialchars('Adresse Mail trop longue').'</p></div>';
                                break;
                            case 'already':
                                echo '<div id="error"><p>'.htmlspecialchars('Compte déjà existant').'</p></div>';
                                break;
                            default:
                                echo '<div id="error"><p>'.htmlspecialchars('Erreur').'</p></div>';
                                break;
                        }
                    }
                ?>
                <input name="submit" type="submit" value="INSCRIPTION"/>
            </form>
        </main>

        <footer>
            <p>Déjà un compte ? <a href="./admin.php" title="Se connecter">Cliquez ici</a></p>
        </footer>
    </body>
</html>
