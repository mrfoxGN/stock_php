/* Créer la base de donnees */
CREATE DATABASE IF NOT EXISTS gestion_stock;

/* Usage de bdd */

USE gestion_stock;
/* Table Users */ 


CREATE TABLE IF NOT EXISTS Users (
    IdU int PRIMARY KEY AUTO_INCREMENT,
    Nom varchar(50),
    Prenom varchar(50),
    Age int,
    Email varchar(50),
    Pass_word varchar(50)
);

/* Table Produits */ 
CREATE TABLE IF NOT EXISTS Produits (
    IdP int PRIMARY KEY AUTO_INCREMENT,
    IdU int,
    Nom_Produit varchar(50),
    Prix float,
    Quantite int,
    Categorie VARCHAR(70),
    FOREIGN KEY (IdU) REFERENCES Users(IdU)
);
