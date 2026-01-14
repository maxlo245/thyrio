-- Script d'exemple pour la base de données de la boutique

-- Crée la base (si elle n'existe pas déjà)
CREATE DATABASE IF NOT EXISTS boutique_en_ligne CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE boutique_en_ligne;

-- Table produits
DROP TABLE IF EXISTS products;
CREATE TABLE products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    shopify_checkout_url VARCHAR(500) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Quelques produits de test (URLs Shopify à remplacer par les tiennes)
INSERT INTO products (name, description, price, shopify_checkout_url) VALUES
('T-shirt noir', 'T-shirt noir en coton 100% avec logo.', 19.99, 'https://TON-DOMAIN.myshopify.com/products/t-shirt-noir'),
('Sweat à capuche', 'Sweat confortable pour les soirées fraîches.', 39.90, 'https://TON-DOMAIN.myshopify.com/products/sweat-a-capuche'),
('Casquette', 'Casquette réglable, taille unique.', 14.50, 'https://TON-DOMAIN.myshopify.com/products/casquette');
