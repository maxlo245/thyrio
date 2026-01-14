<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Cart.php';

class ProductController
{
    private PDO $pdo;

    public function __construct()
    {
        global $pdo; // vient de src/config/db.php
        $this->pdo = $pdo;
    }

    public function home(): void
    {
        $productModel = new Product($this->pdo);
        $products = $productModel->getAll();
        include __DIR__ . '/../../templates/home.php';
    }

    public function show(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $productModel = new Product($this->pdo);
        $product = $productModel->getById($id);
        include __DIR__ . '/../../templates/product_detail.php';
    }
}
