<?php
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SAÉ23 - Monitoring bâtiments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>SAÉ23 - Monitoring des bâtiments</h1>
    <nav>
        <!-- Links visible to everyone -->
        <a href="index.php">Accueil</a>
        <a href="consultation.php">Consultation</a>
        <a href="projet.php">Gestion de projet</a>
        <!-- Show Administration link only if user is admin -->
        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") { ?>
            <a href="admin.php">Administration</a>
        <?php } ?>
        <!-- Show Gestion link only if user is a manager -->
        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "gestionnaire") { ?>
            <a href="gestion.php">Gestion</a>
        <?php } ?>
        <!-- Show Deconnexion if logged in, Connexion otherwise -->
        <?php if (isset($_SESSION["user_id"])) { ?>
            <a href="deconnexion.php">Déconnexion</a>
        <?php } else { ?>
            <a href="connexion.php">Connexion</a>
        <?php } ?>
    </nav>
</header>
<main>
