<?php
require_once 'classes/Product.php';
$productObj = new Product();
$promoProducts = $productObj->getPromotionalProducts();
?>

<?php include 'includes/header.php'; ?>

<div class="container mb-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
            <?php include 'includes/sidebar.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <h2 class="mb-4 fw-bold text-danger">NOS PROMOTIONS</h2>

            <?php if (empty($promoProducts)): ?>
                <div class="alert alert-info text-center">
                    Aucune promotion disponible pour le moment.
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($promoProducts as $product): ?>
                        <div class="col">
                            <div class="card product-card h-100">
                                <!-- Calculate Discount Percentage -->
                                <?php
                                $saving = $product['old_price'] - $product['price'];
                                $percent = round(($saving / $product['old_price']) * 100);
                                ?>
                                <span class="product-badge bg-danger">-
                                    <?php echo $percent; ?>%
                                </span>

                                <a href="product_details.php?id=<?php echo $product['id']; ?>">
                                    <img src="<?php echo $product['image']; ?>" class="card-img-top product-img"
                                        alt="<?php echo $product['name']; ?>">
                                </a>
                                <div class="card-body text-center">
                                    <small class="text-muted d-block mb-1">
                                        <?php echo $product['category_name']; ?>
                                    </small>
                                    <h5 class="card-title text-truncate mb-2" title="<?php echo $product['name']; ?>">
                                        <a href="product_details.php?id=<?php echo $product['id']; ?>"
                                            class="text-decoration-none text-dark">
                                            <?php echo $product['name']; ?>
                                        </a>
                                    </h5>

                                    <div class="mb-3">
                                        <div class="text-decoration-line-through text-muted small">
                                            <?php echo number_format($product['old_price'], 0, ',', ' '); ?> DH
                                        </div>
                                        <div class="product-price text-danger">
                                            <?php echo number_format($product['price'], 0, ',', ' '); ?> DH
                                        </div>
                                        <div class="small text-success fw-bold">Économisez
                                            <?php echo number_format($saving, 0, ',', ' '); ?> DH
                                        </div>
                                    </div>

                                    <a href="cart_actions.php?action=add&id=<?php echo $product['id']; ?>"
                                        class="btn btn-primary-custom w-100 rounded-pill"><i
                                            class="fas fa-shopping-cart me-1"></i>
                                        Acheter</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>