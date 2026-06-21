<?php // Include header and database connection
include("config.php");
include("header.php");
?>
<?php // Force UTF-8 encoding for special characters
mysqli_set_charset($conn, 'utf8mb4'); ?>

<section class="card">
    <h2>Consultation</h2>
    <table>
        <thead>
            <tr>
                <th>Bâtiment</th>
                <th>Salle</th>
                <th>Capteur</th>
                <th>Dernière valeur</th>
                <th>Date et heure</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Get the last measurement for each sensor
        $sql = "
        SELECT b.nom AS batiment, s.nom AS salle, c.nom AS capteur, c.unite, m.valeur, m.date_heure
        FROM mesure m
        JOIN capteur c ON m.id_capteur = c.id_capteur
        JOIN salle s ON c.id_salle = s.id_salle
        JOIN batiment b ON s.id_batiment = b.id_batiment
        WHERE m.date_heure = (
            SELECT MAX(m2.date_heure) FROM mesure m2 WHERE m2.id_capteur = m.id_capteur
        )
        ORDER BY b.nom, s.nom
        ";
        $result = mysqli_query($conn, $sql);
        // Loop through results and display each row
        while ($m = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($m['batiment']) ?></td>
            <td><?= htmlspecialchars($m['salle']) ?></td>
            <td><?= htmlspecialchars($m['capteur']) ?></td>
            <td><?= $m['valeur'] ?> <?= $m['unite'] ?></td>
            <td><?= $m['date_heure'] ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</section>
<?php include("footer.php"); ?>
