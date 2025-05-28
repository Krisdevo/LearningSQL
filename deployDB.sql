-- Création de la table de commandes

CREATE TABLE IF NOT EXISTS commandes(

    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    produit VARCHAR(100) NOT NULL,
    quantite INT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

--Insertions de données dans la table users

INSERT INTO users (name,email)
VALUES
('Alice Dupont', 'alice@mara.com'),
('Bob Martin', 'bob@mara.com'),
('Céline Dupuy' , 'cdupuy@moli.com');

--Insertions de données dans la table commandes

INSERT INTO commandes (user_id,produit,quantite,prix)
VALUES
(1,'Ordinateur Portable',1,950.00),
(1,'Clé USB 64GO',3,14.00),
(2,'Ecran 27"',1,350.00),
(3,'Casque Audio',1,50.00),
(1,'Souris Gamer',1,50.00);