<?php
    session_start();
    require_once './API/API.php';

    if(isset($_SESSION['user'])){
        header('Location: ./admin.php');
        exit();
    }

    if (isset($_POST['submit'])) {
        $database = new Database();
        $userHandler = new UserHandler($database);
        $userHandler->loginUser($_POST['mail'], $_POST['password']);
    }
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="stylelogin.css">
    <link rel="shortcut icon" href="../image/heartbeat-solid.svg" type="image/x-icon">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

<main>
    <h2>Connexion</h2>

    <form class="form-box" action="" method="post">
        <input type="email" name="mail" id="email" placeholder="E-mail" required/>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required/>

        <?php
        if(isset($_GET['err'])){
            extract($_GET);

            switch($err){
                case 'password':
                    echo '<div id="error"><p>'.htmlspecialchars('Mot de passe incorrect').'</p></div>';
                    break;
                case 'email':
                    echo '<div id="error"><p>'.htmlspecialchars('Adresse mail incorrecte').'</p></div>';
                    break;
                case 'none':
                    echo '<div id="error"><p>'.htmlspecialchars('Compte inexistant').'</p></div>';
                    break;
                default:
                    echo '<div id="error"><p>'.htmlspecialchars('Erreur').'</p></div>';
                    break;
            }
        }
        ?>
        <input name="submit" type="submit" value="CONNEXION"/>
    </form>

    <input name="button" type="button" onclick="window.location.href='../index.html';" value="Retourner à l'accueil" />

</main>

<footer>
    <p>Pas encore de compte ? <a href="./register.php" title="S'inscrire">Cliquez ici</a></p>
</footer>
</body>
</html>
