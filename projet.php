<?php include("header.php"); ?>

<h2>Gestion de projet</h2>

<!-- GANTT diagram section -->
<section class="card">
    <h3>Diagramme de GANTT</h3>
    <img src="images/gantSAE23.png" alt="Diagramme de GANTT" style="width:85%;">
</section>

<!-- Collaborative tools section -->
<section class="card">
    <h3>Outils collaboratifs</h3>
    <img src="images/github.png" alt="Github" style="width:85%;">
</section>

<!-- Personal summary section for each group member -->
<section class="card">
    <h3>Synthèse personnelle</h3>
    <p><strong>Bouglon Simon</strong> : Mise en place de Node-RED, création de la base de données MySQL et développement du script de transfert MQTT vers MySQL. Problème rencontré : transmission des données entre services, résolu en testant les flows Node-RED et en validant les insertions MySQL.</p>
    <p><strong>Hajjout Ilyas</strong> : Analyse du cahier des charges, mise en place de GitHub, installation de la VM Lubuntu et Docker, configuration de MQTT et conception de la base de données. Problème rencontré : mise en place de l'environnement, résolu grâce à une documentation claire et des tests progressifs.</p>
    <p><strong>Atoui Mohamad</strong> : Réalisation du dashboard Grafana, développement de la page consultation et participation aux tests. Problème rencontré : affichage correct des données en temps réel, résolu en vérifiant les requêtes et les paramètres d'affichage.</p>
    <p><strong>Oubaiche Matisse</strong> : Développement du site web (accueil, gestion, administration, comptes). Problème rencontré : intégration des pages du site, résolu grâce à une structure de développement claire et des tests réguliers.</p>
</section>

<!-- Conclusion and satisfaction level -->
<section class="card">
    <h3>Conclusion</h3>
    <p>Le cahier des charges a été respecté dans son ensemble. Le système est fonctionnel : les données des 4 capteurs sont collectées, stockées dans MySQL et InfluxDB, visualisées dans Grafana et affichées sur le site web avec des accès sécurisés par rôle. Les principales difficultés liées à la cohérence des données et aux problèmes d'encodage ont été résolues. Ce projet nous a permis de mettre en pratique des compétences en réseaux, bases de données, développement web.</p>
</section>

<?php include("footer.php"); ?>
