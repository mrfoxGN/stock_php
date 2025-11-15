/* Créer la base de donnees */
CREATE DATABASE IF NOT EXISTS gestion_stock;

/* Usage de bdd */
USE gestion_stock;

/* Table Categorie */ 
CREATE TABLE IF NOT EXISTS Categorie (
    IdC int PRIMARY KEY AUTO_INCREMENT,
    Nom_Categorie varchar(50)
);

/* Table Produits */ 
CREATE TABLE IF NOT EXISTS Produits (
    IdP int PRIMARY KEY AUTO_INCREMENT,
    IdC int,
    Nom_Produit varchar(50),
    Prix float,
    Date_Ajout date,
    Quantite int,
    FOREIGN KEY (IdC) REFERENCES Categorie(IdC)
);

/* Table Users */ 
CREATE TABLE IF NOT EXISTS Users (
    IdU int PRIMARY KEY AUTO_INCREMENT,
    Nom varchar(50),
    Prenom varchar(50),
    Age int,
    Email varchar(50),
    Pass_word varchar(50)
);