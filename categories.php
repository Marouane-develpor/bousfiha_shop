<?php
require_once 'classes/Product.php';
$productObj = new Product();
$categoryName = isset($_GET['name']) ? $_GET['name'] : null;

if ($categoryName) {
    // Show products for specific category
    $products = $productObj->getProductsByCategory($categoryName);
    $pageTitle = $categoryName;
} else {
    // Show all categories
    $categories = $productObj->getCategories();
    $pageTitle = "Toutes les Catégories";

    // Icon mapping
    $categoryIcons = [
        'TV' => 'fas fa-tv',
        'Audio' => 'fa-solid fa-radio',
        'Gros Electroménager' => 'fas fa-snowflake', // or fa-plug
        'Encastrable' => 'fas fa-burn',
        'Petit Electroménager' => 'fas fa-blender',
        'Smartphone' => 'fas fa-mobile-alt',
        'Informatique' => 'bi bi-usb-symbol',
        'Gaming' => 'fas fa-gamepad',
        // Default
        'default' => 'fas fa-folder-open'
    ];
}
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
            <?php if ($categoryName): ?>
                <h2 class="mb-4 text-center fw-bold">
                    <i
                        class="<?php echo isset($categoryIcons[$categoryName]) ? $categoryIcons[$categoryName] : 'fas fa-box'; ?> me-2 text-primary-custom"></i>
                    <?php echo $categoryName; ?>
                </h2>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php if (empty($products)): ?>
                        <div class="col-12 text-center">
                            <p class="text-muted">Aucun produit trouvé dans cette catégorie.</p>
                            <a href="categories.php" class="btn btn-outline-primary rounded-pill">Voir toutes les catégories</a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
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
                                            <span class="product-price"><?php echo number_format($product['price'], 0, ',', ' '); ?>
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
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <h2 class="mb-5 text-center fw-bold">Nos Catégories</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($categories as $cat): // Changed $availableCategories to $categories as it's defined ?>
                        <div class="col">
                            <a href="categories.php?name=<?php echo urlencode($cat); ?>" class="text-decoration-none">
                                <div class="card h-100 shadow-sm border-0 category-card-hover text-center py-5">
                                    <div class="card-body">
                                        <i
                                            class="<?php echo isset($categoryIcons[$cat]) ? $categoryIcons[$cat] : 'fas fa-box'; ?> fa-4x text-primary-custom mb-3"></i>
                                        <h4 class="card-title text-dark fw-bold"><?php echo $cat; ?></h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>