<?php
// Start session and include database connection
session_start();
include("config.php");

// Redirect to login if user is not a manager
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "gestionnaire") {
    header("Location: connexion.php");
    exit();
}

// Get the manager id from the session
$id_gestionnaire = $_SESSION["user_id"];

// Get the building associated with the logged-in manager
$sql_bat = "SELECT id_batiment, nom FROM batiment WHERE id_gestionnaire = $id_gestionnaire";
$result_bat = mysqli_query($conn, $sql_bat);
$batiment = mysqli_fetch_assoc($result_bat);
$id_batiment = $batiment["id_batiment"];
$nom_batiment = $batiment["nom"];
?>
<?php include("header.php"); ?>

<section class="card">
    <h2>Gestion - <?= htmlspecialchars($nom_batiment) ?></h2>
    <table>
        <thead>
            <tr>
                <th>Salle</th>
                <th>Capteur</th>
                <th>Moyenne</th>
                <th>Min</th>
                <th>Max</th>
                <th>Dernière mesure</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Get average, min, max and last measurement for each sensor in the manager's building
        $sql = "
        SELECT s.nom AS salle, c.nom AS capteur, c.unite,
            ROUND(AVG(m.valeur), 2) AS moyenne,
            ROUND(MIN(m.valeur), 2) AS minimum,
            ROUND(MAX(m.valeur), 2) AS maximum,
            MAX(m.date_heure) AS derniere_mesure
        FROM mesure m
        JOIN capteur c ON m.id_capteur = c.id_capteur
        JOIN salle s ON c.id_salle = s.id_salle
        WHERE s.id_batiment = $id_batiment
        GROUP BY c.id_capteur
        ORDER BY s.nom
        ";
        $result = mysqli_query($conn, $sql);
        // Loop through results and display each row
        while ($m = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($m['salle']) ?></td>
            <td><?= htmlspecialchars($m['capteur']) ?> (<?= $m['unite'] ?>)</td>
            <td><?= $m['moyenne'] ?> <?= $m['unite'] ?></td>
            <td><?= $m['minimum'] ?> <?= $m['unite'] ?></td>
            <td><?= $m['maximum'] ?> <?= $m['unite'] ?></td>
            <td><?= $m['derniere_mesure'] ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</section>
<?php include("footer.php"); ?>
