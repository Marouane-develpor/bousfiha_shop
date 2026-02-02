<?php
require_once 'classes/Cart.php';

$cart = new Cart();

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

/* Handle Add to Cart */
if ($action === 'add' && $id > 0) {
    $cart->addToCart($id);
}

/* Handle Remove */
if ($action === 'remove' && $id > 0) {
    $cart->removeFromCart($id);
}

/* Handle Clear */
if ($action === 'clear') {
    $cart->clearCart();
}

// Redirect back to previous page
$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
header("Location: $redirect");
exit;
