
<?php
    session_start();
    require_once './API/API.php';

    // Vérifier si l'utilisateur est connecté ou non
    if (!isset($_SESSION['user'])) {
        header('Location: ./login.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Lifeguard Connect</title> 
    <link rel="shortcut icon" href="../image/heartbeat-solid.svg" type="image/x-icon">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <a href="#" class="logo"><i class="fas fa-heartbeat"></i> Lifeguard.</a>
        <nav class="navbar">
            <a href="logout.php">Déconnexion</a>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </div>
    <!-- Header -->


    <section class="home" id="home">
        <div class="image">
            <img src="../image/home-img.svg" alt="home-img.svg">
        </div>
        <div class="content">
            <h3>Bienvenu sur le Panel Famille</h3>
            <p>Ici, vous pourrez avoir toutes les informations concernant votre proche.</p>
            <a href="#famille" class="btn">Espace famille<span class="fas fa-chevron-right"></span> </a>
        </div>
    </section>

    <section class="contact" id="contact">
        <h1 class="heading"><span>contactez</span> nous</h1>
        <div class="row">
            <div class="image">
                <img src="../image/book-img.svg" alt="">
            </div>
            <form action="">
                <h3>prendre rendez-vous</h3>
                <input type="text" placeholder="Nom" class="box">
                <input type="number" placeholder="Tél" class="box">
                <input type="email" placeholder="email" class="box">
                <input type="date" class="box">
                <input type="submit" onclick="window.location.href='#home';" value="Prendre rendez-vous" class="btn">
            </form>
        </div>
    </section>

    <section class="famille" id="famille">
        <div class="content">
            <h3>Espace Famille</h3>
            <!-- 
                LOCALISATION
                ALERTE LUMINEUSE & SONOR
                Numero chambre
            
            -->
            <a href="#stats" class="btn">Statistiques<span class="fas fa-chevron-right"></span> </a>
        </div>
    </section>

    <section class="stats" id="stats">
        <div class="content">
            <h3>Espace Statistiques</h3>
            <!-- 
                stats chute
                stats fugue
                Stats alerte
            -->
            <a href="#home" class="btn">Homes<span class="fas fa-chevron-right"></span> </a>
        </div>
    </section>


    <!-- Footer -->
    <section class="footer">
        <div class="credit">created by <span>Jamel Rabla</span> | all right reserved</div>
    </section>
    <!-- Footer  -->
</body>
</html>

