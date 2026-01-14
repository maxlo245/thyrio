<?php

require_once __DIR__ . '/../models/Cart.php';

class CartController
{
    private Cart $cart;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    public function showCart(): void
    {
        $items = $this->cart->all();
        include __DIR__ . '/../../templates/cart.php';
    }

    public function add(): void
    {
        $productId = (int) ($_POST['product_id'] ?? 0);
        $qty = (int) ($_POST['qty'] ?? 1);
        $this->cart->add($productId, $qty);
        header('Location: index.php?page=cart');
        exit;
    }
}
