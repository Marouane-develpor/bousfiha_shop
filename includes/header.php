<?php
if (!class_exists('Product')) {
    require_once dirname(__DIR__) . '/classes/Product.php';
}

if (!class_exists('Cart')) {
    require_once dirname(__DIR__) . '/classes/Cart.php';
}

if (!isset($productObj)) {
    $productObj = new Product();
}
if (!isset($cartObj)) {
    $cartObj = new Cart();
}

$cartCount = $cartObj->getCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bousfiha Electro | Electroménager Maroc</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

    <div class="top-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-2"></i> +212 535 551 145</span>
                <span><i class="fas fa-envelope me-2"></i> contact@electrobousfiha.com</span>
            </div>
            <div>
                <a href="#"><i class="fas fa-map-marker-alt me-1"></i> Nos Magasins</a>
                <a href="#">Qui sommes-nous</a>
                <a href="#">Contact</a>
            </div>
        </div>
    </div>

    <header class="main-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <a href="index.php" class="text-decoration-none">
                        <h2 class="fw-bold text-dark m-0 d-flex align-items-center">
                            <span>ELECTRO <span class="text-primary-custom">BOUSFIHA</span></span>
                        </h2>
                    </a>
                </div>

                <div class="col-md-6">
                    <div class="input-group search-bar-container mx-auto">
                        <input type="text" class="form-control search-input" placeholder="Rechercher un produit...">
                        <button class="btn search-btn" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class="col-md-3 text-end">
                    <a href="login.php" class="text-dark me-3 text-decoration-none">
                        <i class="fas fa-user fa-lg mb-1 d-block"></i>
                        <small>Compte</small>
                    </a>
                    <a href="cart.php" class="text-dark text-decoration-none position-relative">
                        <i class="fas fa-shopping-cart fa-lg mb-1 d-block"></i>
                        <small>Panier</small>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo isset($cartCount) ? $cartCount : 0; ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg main-nav">
        <div class="container">
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="fas fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav w-100 justify-content-between">
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php"><i class="fas fa-bars me-2"></i> TOUTES LES
                            CATÉGORIES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="promotions.php">PROMOTIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php?name=TV">TÉLÉVISEURS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php?name=Gros%20Electroménager">GROS ELECTROMÉNAGER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php?name=Petit%20Electroménager">PETIT ELECTROMÉNAGER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php?name=Informatique">INFORMATIQUE</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>