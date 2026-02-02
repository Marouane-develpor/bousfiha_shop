<?php
require_once 'classes/Product.php';
$productObj = new Product();
$allProducts = $productObj->getAllProducts();
$promoProducts = $productObj->getPromotionalProducts();
?>

<?php include 'includes/header.php'; ?>

<!-- Hero Slider -->
<div id="heroCarousel" class="carousel slide hero-slider mb-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/SOLDE D'ETE.jpg"
                class="d-block w-100" alt="Promo 1">
            <div class="carousel-caption d-none d-md-block">
                <h3>Les Meilleures Offres de l'Été</h3>
                <p>Equipez votre maison avec les meilleures marques.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/images/Nouvelle Collection Samsung.jpg"
                class="d-block w-100" alt="Promo 2">
            <div class="carousel-caption d-none d-md-block">
                <h3>Nouvelle Collection Samsung</h3>
                <p>Découvrez les dernières innovations TV et Electroménager.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Special Offers Section -->
<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><span class="text-primary-custom">OFFRES</span> DE LA SEMAINE</h2>
        <a href="#" class="btn btn-outline-dark btn-sm rounded-pill px-4">Voir Tout</a>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php foreach ($promoProducts as $product): ?>
            <div class="col">
                <div class="card product-card">
                    <?php if ($product['badge']): ?>
                        <span class="product-badge"><?php echo $product['badge']; ?></span>
                    <?php endif; ?>
                    <a href="product_details.php?id=<?php echo $product['id']; ?>">
                        <img src="<?php echo $product['image']; ?>" class="card-img-top product-img"
                            alt="<?php echo $product['name']; ?>">
                    </a>
                    <div class="card-body text-center">
                        <small class="text-muted d-block mb-1"><?php echo $product['category_name']; ?></small>
                        <h6 class="card-title text-truncate mb-2" title="<?php echo $product['name']; ?>">
                            <a href="product_details.php?id=<?php echo $product['id']; ?>"
                                class="text-decoration-none text-dark">
                                <?php echo $product['name']; ?>
                            </a>
                        </h6>
                        <div class="mb-2">
                            <span
                                class="product-price"><?php echo number_format($product['price'], 0, ',', ' '); ?>
                                DH</span>
                            <?php if ($product['old_price']): ?>
                                <span
                                    class="product-old-price ms-2"><?php echo number_format($product['old_price'], 0, ',', ' '); ?>
                                    DH</span>
                            <?php endif; ?>
                        </div>
                        <a href="cart_actions.php?action=add&id=<?php echo $product['id']; ?>"
                            class="btn btn-primary-custom w-100 btn-sm rounded-pill"><i
                                class="fas fa-shopping-cart me-1"></i> Ajouter</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- All Products Section -->
<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">NOS MEILLEURES <span class="text-primary-custom">VENTES</span></h2>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php foreach ($allProducts as $product): ?>
            <!-- Skip already shown promos if desirable, simplified here to show all -->
            <div class="col">
                <div class="card product-card">
                    <?php if (isset($product['badge']) && $product['badge']): ?>
                        <span class="product-badge"><?php echo $product['badge']; ?></span>
                    <?php endif; ?>
                    <a href="product_details.php?id=<?php echo $product['id']; ?>">
                        <img src="<?php echo $product['image']; ?>" class="card-img-top product-img"
                            alt="<?php echo $product['name']; ?>">
                    </a>
                    <div class="card-body text-center">
                        <small class="text-muted d-block mb-1"><?php echo $product['category_name']; ?></small>
                        <h6 class="card-title text-truncate mb-2" title="<?php echo $product['name']; ?>">
                            <a href="product_details.php?id=<?php echo $product['id']; ?>"
                                class="text-decoration-none text-dark">
                                <?php echo $product['name']; ?>
                            </a>
                        </h6>
                        <div class="mb-2">
                            <span
                                class="product-price"><?php echo number_format($product['price'], 0, ',', ' '); ?>
                                DH</span>
                        </div>
                        <a href="cart_actions.php?action=add&id=<?php echo $product['id']; ?>"
                            class="btn btn-primary-custom w-100 btn-sm rounded-pill"><i
                                class="fas fa-shopping-cart me-1"></i> Ajouter</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>