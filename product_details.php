<?php
require_once 'classes/Product.php';
require_once 'classes/Cart.php';

$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$productObj = new Product();
$cartObj = new Cart();
$product = $productObj->getProductById($productId);

// Redirect to home if product not found
if (!$product) {
    header('Location: index.php');
    exit;
}

$cartCount = $cartObj->getCount();
?>

<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
            <?php include 'includes/sidebar.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" class="text-dark text-decoration-none">Accueil</a>
                    </li>
                    <li class="breadcrumb-item"><a
                            href="categories.php?name=<?php echo urlencode($product['category_name']); ?>"
                            class="text-dark text-decoration-none">
                            <?php echo $product['category_name']; ?>
                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo $product['name']; ?>
                    </li>
                </ol>
            </nav>

            <div class="row g-5 mt-3">
                <!-- Product Image -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-3">
                        <img src="<?php echo $product['image']; ?>" class="img-fluid rounded"
                            alt="<?php echo $product['name']; ?>">
                        <?php if (isset($product['badge']) && $product['badge']): ?>
                            <span class="position-absolute top-0 start-0 m-3 badge bg-danger fs-5 px-3 py-2">
                                <?php echo $product['badge']; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6">
                    <h1 class="fw-bold mb-3">
                        <?php echo $product['name']; ?>
                    </h1>
                    <div class="mb-3">
                        <span class="badge bg-light text-dark border me-2">
                            <?php echo $product['category_name']; ?>
                        </span>
                        <span class="text-muted"><i class="fas fa-check-circle text-success me-1"></i> En Stock</span>
                    </div>

                    <div class="mb-4">
                        <?php if (isset($product['old_price']) && $product['old_price']): ?>
                            <span class="text-decoration-line-through text-muted fs-4 me-3">
                                <?php echo number_format($product['old_price'], 0, ',', ' '); ?> DH
                            </span>
                        <?php endif; ?>
                        <span class="display-5 fw-bold text-primary-custom">
                            <?php echo number_format($product['price'], 0, ',', ' '); ?> DH
                        </span>
                    </div>

                    <p class="lead text-muted mb-4">
                        Découvrez le
                        <?php echo $product['name']; ?>, conçu pour répondre à tous vos besoins.
                        Profitez d'une qualité exceptionnelle et d'une performance durable.
                        Garantie officielle de 2 ans incluse.
                    </p>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-5">
                        <a href="cart_actions.php?action=add&id=<?php echo $product['id']; ?>"
                            class="btn btn-primary-custom btn-lg px-5 rounded-pill shadow-sm">
                            <i class="fas fa-shopping-cart me-2"></i> Ajouter au panier
                        </a>

                    </div>

                    <div class="card bg-light border-0 rounded-3">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-4 border-end">
                                    <i class="fas fa-truck fa-2x text-muted mb-2"></i>
                                    <p class="small mb-0">Livraison Rapide</p>
                                </div>
                                <div class="col-4 border-end">
                                    <i class="fas fa-shield-alt fa-2x text-muted mb-2"></i>
                                    <p class="small mb-0">Garantie 2 Ans</p>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-headset fa-2x text-muted mb-2"></i>
                                    <p class="small mb-0">Support 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products Section -->
            <div class="mt-5">
                <h3 class="fw-bold mb-4">Produits Similaires</h3>
                <?php
                $relatedProducts = $productObj->getProductsByCategory($product['category_name']);
                // Remove current product from related list
                $relatedProducts = array_filter($relatedProducts, function ($p) use ($productId) {
                    return $p['id'] != $productId;
                });
                // Limit to 4 products
                $relatedProducts = array_slice($relatedProducts, 0, 4);
                ?>

                <?php if (empty($relatedProducts)): ?>
                    <p class="text-muted">Aucun autre produit dans cette catégorie.</p>
                <?php else: ?>
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <?php foreach ($relatedProducts as $relProduct): ?>
                            <div class="col">
                                <div class="card product-card h-100">
                                    <?php if (isset($relProduct['badge']) && $relProduct['badge']): ?>
                                        <span class="product-badge"><?php echo $relProduct['badge']; ?></span>
                                    <?php endif; ?>
                                    <a href="product_details.php?id=<?php echo $relProduct['id']; ?>">
                                        <img src="<?php echo $relProduct['image']; ?>" class="card-img-top product-img"
                                            alt="<?php echo $relProduct['name']; ?>">
                                    </a>
                                    <div class="card-body text-center">
                                        <small
                                            class="text-muted d-block mb-1"><?php echo $relProduct['category_name']; ?></small>
                                        <h6 class="card-title text-truncate mb-2" title="<?php echo $relProduct['name']; ?>">
                                            <a href="product_details.php?id=<?php echo $relProduct['id']; ?>"
                                                class="text-decoration-none text-dark">
                                                <?php echo $relProduct['name']; ?>
                                            </a>
                                        </h6>
                                        <div class="mb-2">
                                            <span
                                                class="product-price"><?php echo number_format($relProduct['price'], 0, ',', ' '); ?>
                                                DH</span>
                                        </div>
                                        <a href="cart_actions.php?action=add&id=<?php echo $relProduct['id']; ?>"
                                            class="btn btn-primary-custom w-100 btn-sm rounded-pill">
                                            <i class="fas fa-shopping-cart me-1"></i> Ajouter
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>