CREATE DATABASE IF NOT EXISTS sae23 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sae23;

DROP TABLE IF EXISTS mesures;
DROP TABLE IF EXISTS capteurs;
DROP TABLE IF EXISTS salles;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS batiments;

CREATE TABLE batiments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    role ENUM('admin', 'gestionnaire') NOT NULL,
    batiment_id INT NULL,
    FOREIGN KEY (batiment_id) REFERENCES batiments(id)
);

CREATE TABLE salles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE,
    type VARCHAR(100) NOT NULL,
    capacite INT NOT NULL,
    batiment_id INT NOT NULL,
    FOREIGN KEY (batiment_id) REFERENCES batiments(id)
);

CREATE TABLE capteurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE,
    type VARCHAR(100) NOT NULL,
    unite VARCHAR(20) NOT NULL,
    salle_id INT NOT NULL,
    FOREIGN KEY (salle_id) REFERENCES salles(id)
);

CREATE TABLE mesures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_mesure DATE NOT NULL,
    heure_mesure TIME NOT NULL,
    valeur FLOAT NOT NULL,
    capteur_id INT NOT NULL,
    FOREIGN KEY (capteur_id) REFERENCES capteurs(id)
);

INSERT INTO batiments (id, nom) VALUES
(1, 'RT'),
(2, 'GIM');

INSERT INTO users (login, password, role, batiment_id) VALUES
('admin', 'admin123', 'admin', NULL),
('gestion_rt', 'rt123', 'gestionnaire', 1),
('gestion_gim', 'gim123', 'gestionnaire', 2);

INSERT INTO salles (nom, type, capacite, batiment_id) VALUES
('E105', 'Salle TP', 24, 1),
('E106', 'Salle cours', 30, 1),
('B112', 'Salle TP', 24, 2),
('B113', 'Salle cours', 30, 2);

INSERT INTO capteurs (nom, type, unite, salle_id) VALUES
('Temp_E105', 'temperature', '°C', 1),
('Hum_E106', 'humidite', '%', 2),
('Temp_B112', 'temperature', '°C', 3),
('Hum_B113', 'humidite', '%', 4);

INSERT INTO mesures (date_mesure, heure_mesure, valeur, capteur_id) VALUES
('2026-06-18', '10:00:00', 22.5, 1),
('2026-06-18', '11:00:00', 23.1, 1),
('2026-06-18', '10:00:00', 45, 2),
('2026-06-18', '11:00:00', 48, 2),
('2026-06-18', '10:00:00', 19.8, 3),
('2026-06-18', '11:00:00', 20.2, 3),
('2026-06-18', '10:00:00', 52, 4),
('2026-06-18', '11:00:00', 50, 4);
