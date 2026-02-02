<?php
require_once 'classes/Cart.php';

// Mock processing
// In a real app, we would save the order to a database here

$cartObj = new Cart();
$cartObj->clearCart(); // Clear the cart after successful order

?>
<?php include 'includes/header.php'; ?>

<div class="container my-5 text-center">
    <div class="py-5">
        <i class="fas fa-check-circle text-success fa-5x mb-4"></i>
        <h2 class="fw-bold mb-3">Commande Confirmée !</h2>
        <p class="lead mb-4">Merci de votre confiance. Votre commande a été enregistrée avec succès.</p>
        <p class="text-muted mb-4">Un email de confirmation vous a été envoyé.</p>
        <a href="index.php" class="btn btn-primary-custom rounded-pill px-5">Retour à l'accueil</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>