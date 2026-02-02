<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <h3 class="text-center fw-bold mb-4">Créer un compte</h3>

                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom Complet</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 rounded-pill">S'inscrire</button>
                    </form>

                    <div class="text-center mt-3">
                        <p class="mb-0">Déjà un compte ? <a href="login.php" class="text-primary-custom fw-bold">Se
                                connecter</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>