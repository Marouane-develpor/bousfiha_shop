<?php
require_once 'classes/Cart.php';
require_once 'classes/Product.php';

$cartObj = new Cart();
$productObj = new Product();
$cartItems = $cartObj->getCartItems();

if (empty($cartItems)) {
    header('Location: cart.php');
    exit;
}

$total = 0;
foreach ($cartItems as $productId => $qty) {
    $product = $productObj->getProductById($productId);
    if ($product) {
        $total += $product['price'] * $qty;
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container mb-5">
    <div class="py-5 text-center">
        <h2 class="fw-bold">Paiement</h2>
        <p class="lead">Veuillez remplir le formulaire ci-dessous pour finaliser votre commande.</p>
    </div>

    <div class="row g-5">
        <!-- Order Summary -->
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary-custom">Votre panier</span>
                <span class="badge bg-primary-custom rounded-pill">
                    <?php echo $cartObj->getCount(); ?>
                </span>
            </h4>
            <ul class="list-group mb-3 shadow-sm">
                <?php foreach ($cartItems as $productId => $qty):
                    $product = $productObj->getProductById($productId);
                    if (!$product)
                        continue;
                    $lineTotal = $product['price'] * $qty;
                    ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">
                                <?php echo $product['name']; ?>
                            </h6>
                            <small class="text-muted">Qté:
                                <?php echo $qty; ?>
                            </small>
                        </div>
                        <span class="text-muted">
                            <?php echo number_format($lineTotal, 0, ',', ' '); ?> DH
                        </span>
                    </li>
                <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <span class="fw-bold">Total (DH)</span>
                    <strong class="text-primary-custom">
                        <?php echo number_format($total, 0, ',', ' '); ?> DH
                    </strong>
                </li>
            </ul>
        </div>

        <!-- Billing Details -->
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Adresse de facturation</h4>
            <form action="process_order.php" method="POST" class="needs-validation" novalidate>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value=""
                            required>
                    </div>

                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value=""
                            required>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email <span class="text-muted">(Optionnel)</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St"
                            required>
                    </div>

                    <div class="col-12">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="06..." required>
                    </div>

                    <div class="col-md-5">
                        <label for="city" class="form-label">Ville</label>
                        <select class="form-select" id="city" name="city" required>
                            <option value="">Choisir...</option>
                            <option>Casablanca</option>
                            <option>Rabat</option>
                            <option>Marrakech</option>
                            <option>Fès</option>
                            <option>Tanger</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <h4 class="mb-3">Paiement</h4>

                <div class="my-3">
                    <div class="form-check">
                        <input id="cod" name="paymentMethod" type="radio" class="form-check-input" value="cod" checked
                            required>
                        <label class="form-check-label" for="cod">Paiement à la livraison</label>
                    </div>
                    <div class="form-check">
                        <input id="credit" name="paymentMethod" type="radio" class="form-check-input" value="credit">
                        <label class="form-check-label" for="credit">Carte Bancaire (Canape)</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" value="paypal">
                        <label class="form-check-label" for="paypal">PayPal</label>
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary-custom btn-lg rounded-pill" type="submit">Confirmer la
                    commande</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>