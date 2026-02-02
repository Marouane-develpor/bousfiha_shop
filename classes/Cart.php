<?php

class Cart
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function addToCart($productId, $quantity = 1)
    {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    public function removeFromCart($productId)
    {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

    public function updateQuantity($productId, $quantity)
    {
        if ($quantity <= 0) {
            $this->removeFromCart($productId);
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    public function getCartItems()
    {
        return $_SESSION['cart'];
    }

    public function getCount()
    {
        return array_sum($_SESSION['cart']);
    }

    public function clearCart()
    {
        $_SESSION['cart'] = [];
    }
}
