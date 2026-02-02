<?php
require_once 'classes/Product.php';
require_once 'classes/Cart.php';

$cartObj = new Cart();
$productObj = new Product();
$cartItems = $cartObj->getCartItems();

$total = 0;
?>

<?php include 'includes/header.php'; ?>

<?php include 'includes/header.php'; ?>

<div class="bg-light py-4 mb-4 border-bottom">
    <div class="container">
        <h1 class="fw-bold text-uppercase mb-0"><i class="fas fa-shopping-cart text-primary-custom me-2"></i> Mon Panier
        </h1>
    </div>
</div>

<div class="container mb-5">
    <?php if (empty($cartItems)): ?>
        <div class="text-center py-5">
            <i class="fas fa-shopping-basket fa-4x text-muted mb-3"></i>
            <h3>Votre panier est vide</h3>
            <p class="text-muted">Découvrez nos promotions et remplissez votre panier.</p>
            <a href="index.php" class="btn btn-primary-custom rounded-pill mt-3 px-4">Continuer mes achats</a>
        </div>
    <?php else: ?>
        <div class="row">

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-align-middle mb-0">
                                <thead class="bg-light text-uppercase small text-muted">
                                    <tr>
                                        <th class="py-3 px-4">Produit</th>
                                        <th class="py-3 px-4">Prix</th>
                                        <th class="py-3 px-4">Quantité</th>
                                        <th class="py-3 px-4 text-end">Total</th>
                                        <th class="py-3 px-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cartItems as $productId => $qty):
                                        $product = $productObj->getProductById($productId);
                                        if (!$product)
                                            continue;
                                        $lineTotal = $product['price'] * $qty;
                                        $total += $lineTotal;
                                        ?>
                                        <tr>
                                            <td class="p-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo $product['image']; ?>" alt=""
                                                        class="img-fluid rounded border"
                                                        style="width: 70px; height: 70px; object-fit: contain;">
                                                    <div class="ms-3">
                                                        <h6 class="mb-0 fw-bold">
                                                            <?php echo $product['name']; ?>
                                                        </h6>
                                                        <small class="text-muted">
                                                            <?php echo $product['category_name']; ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 fw-bold text-muted">
                                                <?php echo number_format($product['price'], 0, ',', ' '); ?> DH
                                            </td>
                                            <td class="p-4">
                                                <span class="badge bg-light text-dark border p-2 px-3 fs-6">
                                                    <?php echo $qty; ?>
                                                </span>
                                            </td>
                                            <td class="p-4 text-end fw-bold text-primary-custom fs-5">
                                                <?php echo number_format($lineTotal, 0, ',', ' '); ?> DH
                                            </td>
                                            <td class="p-4 text-end">
                                                <a href="cart_actions.php?action=remove&id=<?php echo $productId; ?>"
                                                    class="text-danger hover-opacity">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-outline-dark rounded-pill"><i class="fas fa-arrow-left me-2"></i>
                        Continuer mes achats</a>
                    <a href="cart_actions.php?action=clear" class="btn btn-outline-danger rounded-pill"><i
                            class="fas fa-trash me-2"></i> Vider le panier</a>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="fw-bold mb-0">Résumé de la commande</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Sous-total</span>
                        <span class="fw-bold">
                            <?php echo number_format($total, 0, ',', ' '); ?> DH
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Livraison</span>
                        <span class="text-success">Gratuite</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fs-5 fw-bold">Total</span>
                        <span class="fs-4 fw-bold text-primary-custom">
                            <?php echo number_format($total, 0, ',', ' '); ?> DH
                        </span>
                    </div>
                    <a href="checkout.php"
                        class="btn btn-primary-custom w-100 py-2 rounded-pill fw-bold text-uppercase shadow-sm">Valider
                        la commande</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>