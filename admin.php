<?php
// Start session and include database connection
session_start();
include("config.php");

// Redirect to login page if user is not admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: connexion.php");
    exit();
}

// Add a new building
if (isset($_POST["ajouter_batiment"]))
    mysqli_query($conn, "INSERT INTO batiment (nom) VALUES ('{$_POST['nom']}')");

// Add a new room linked to a building
if (isset($_POST["ajouter_salle"]))
    mysqli_query($conn, "INSERT INTO salle (nom, id_batiment) VALUES ('{$_POST['nom']}', {$_POST['id_batiment']})");

// Add a new sensor linked to a room
if (isset($_POST["ajouter_capteur"]))
    mysqli_query($conn, "INSERT INTO capteur (nom, type, unite, id_salle) VALUES ('{$_POST['nom']}', '{$_POST['type']}', '{$_POST['unite']}', {$_POST['id_salle']})");

// Delete a building
if (isset($_POST["supprimer_batiment"]))
    mysqli_query($conn, "DELETE FROM batiment WHERE id_batiment = {$_POST['id']}");

// Delete a room
if (isset($_POST["supprimer_salle"]))
    mysqli_query($conn, "DELETE FROM salle WHERE id_salle = {$_POST['id']}");

// Delete a sensor
if (isset($_POST["supprimer_capteur"]))
    mysqli_query($conn, "DELETE FROM capteur WHERE id_capteur = {$_POST['id']}");
?>
<?php include("header.php"); ?>

<section class="card">
<h2>Administration</h2>

<!-- Display all buildings -->
<h3>Bâtiments</h3>
<table>
    <tr><th>Nom</th><th></th></tr>
    <?php $r = mysqli_query($conn, "SELECT * FROM batiment"); while ($row = mysqli_fetch_assoc($r)): ?>
    <tr>
        <td><?= htmlspecialchars($row["nom"]) ?></td>
        <!-- Delete button with hidden building id -->
        <td><form method="POST"><input type="hidden" name="id" value="<?= $row["id_batiment"] ?>"><button name="supprimer_batiment">Supprimer</button></form></td>
    </tr>
    <?php endwhile; ?>
</table>
<!-- Form to add a new building -->
<form method="POST">
    <input type="text" name="nom" placeholder="Nom du bâtiment" required>
    <button name="ajouter_batiment">Ajouter</button>
</form>

<!-- Display all rooms with their building -->
<h3>Salles</h3>
<table>
    <tr><th>Nom</th><th>Bâtiment</th><th></th></tr>
    <?php $r = mysqli_query($conn, "SELECT s.*, b.nom AS bat FROM salle s JOIN batiment b ON s.id_batiment = b.id_batiment"); while ($row = mysqli_fetch_assoc($r)): ?>
    <tr>
        <td><?= htmlspecialchars($row["nom"]) ?></td>
        <td><?= htmlspecialchars($row["bat"]) ?></td>
        <!-- Delete button with hidden room id -->
        <td><form method="POST"><input type="hidden" name="id" value="<?= $row["id_salle"] ?>"><button name="supprimer_salle">Supprimer</button></form></td>
    </tr>
    <?php endwhile; ?>
</table>
<!-- Form to add a new room with building dropdown -->
<form method="POST">
    <input type="text" name="nom" placeholder="Nom de la salle" required>
    <select name="id_batiment">
        <?php $r = mysqli_query($conn, "SELECT * FROM batiment"); while ($b = mysqli_fetch_assoc($r)): ?>
        <option value="<?= $b["id_batiment"] ?>"><?= htmlspecialchars($b["nom"]) ?></option>
        <?php endwhile; ?>
    </select>
    <button name="ajouter_salle">Ajouter</button>
</form>

<!-- Display all sensors with their room -->
<h3>Capteurs</h3>
<table>
    <tr><th>Nom</th><th>Type</th><th>Unité</th><th>Salle</th><th></th></tr>
    <?php $r = mysqli_query($conn, "SELECT c.*, s.nom AS salle FROM capteur c JOIN salle s ON c.id_salle = s.id_salle"); while ($row = mysqli_fetch_assoc($r)): ?>
    <tr>
        <td><?= htmlspecialchars($row["nom"]) ?></td>
        <td><?= htmlspecialchars($row["type"]) ?></td>
        <td><?= htmlspecialchars($row["unite"]) ?></td>
        <td><?= htmlspecialchars($row["salle"]) ?></td>
        <!-- Delete button with hidden sensor id -->
        <td><form method="POST"><input type="hidden" name="id" value="<?= $row["id_capteur"] ?>"><button name="supprimer_capteur">Supprimer</button></form></td>
    </tr>
    <?php endwhile; ?>
</table>
<!-- Form to add a new sensor with room dropdown -->
<form method="POST">
    <input type="text" name="nom" placeholder="Nom du capteur" required>
    <input type="text" name="type" placeholder="Type" required>
    <input type="text" name="unite" placeholder="Unité" required>
    <select name="id_salle">
        <?php $r = mysqli_query($conn, "SELECT * FROM salle"); while ($s = mysqli_fetch_assoc($r)): ?>
        <option value="<?= $s["id_salle"] ?>"><?= htmlspecialchars($s["nom"]) ?></option>
        <?php endwhile; ?>
    </select>
    <button name="ajouter_capteur">Ajouter</button>
</form>

</section>
<?php include("footer.php"); ?>
