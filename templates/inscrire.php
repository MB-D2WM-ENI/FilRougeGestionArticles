<?php require_once '_seo.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?> - S'inscrire</title>
    <meta name="description" content="<?= $description ?>">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
        <a class="navbar-brand" href="/">TP Fil Rouge</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php require '_menu.php'; ?>
    </nav>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Système de Gestion d'Articles</h1>
            <p class="col-md-8 fs-4">S'inscrire</p>
        </div>
    </div>
    <div class="row align-items-md-stretch">
        <div class="col-md-6">
            <div class="h-100 p-5 text-bg-dark rounded-3">
                <h2>Inscription</h2>
                <?php if (isset($success)) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" novalidate=novalidate>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control <?= isset($auteur) && $auteur['prenom'] === '' ? 'is-invalid' : '' ?>" id="prenom" name="prenom" required value="<?= $auteur['prenom'] ?? '' ?>">
                        <div class="invalid-feedback">
                            Veuillez saisir votre prénom.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control <?= isset($auteur) && $auteur['nom'] === '' ? 'is-invalid' : '' ?>" id="nom" name="nom" required value="<?= $auteur['nom'] ?? '' ?>">
                        <div class="invalid-feedback">
                            Veuillez saisir votre nom.
                        </div>
                    </div>
                    <?php
                    /*
                        Nous voyons ici un extrait de formulaire HTML qui est utilisé pour collecter l'adresse e-mail de l'utilisateur dans le fichier inscrire.php. L'élément d'entrée est défini avec l'attribut type="email", qui spécifie que l'entrée doit être validée en tant qu'adresse e-mail par le navigateur.
                        L'élément d'entrée inclut également un attribut class qui ajoute conditionnellement la classe is-invalid à l'élément si l'adresse e-mail est invalide. Cela est fait à l'aide d'un opérateur ternaire qui vérifie si le tableau $utilisateur existe et si la clé email est définie sur false. Si les deux conditions sont vraies, la classe is-invalid est ajoutée à l'élément d'entrée.
                        L'élément d'entrée inclut également un attribut required, qui spécifie que l'entrée doit être remplie avant que le formulaire puisse être soumis. De plus, l'élément d'entrée inclut un attribut value qui définit la valeur par défaut de l'élément d'entrée sur la valeur de la clé $utilisateur['email'], si elle existe.
                        Si l'utilisateur entre une adresse e-mail invalide, l'élément d'entrée sera marqué comme invalide et le navigateur affichera un message d'erreur sous l'élément d'entrée. Le message d'erreur est défini dans l'élément div avec l'attribut class="invalid-feedback", qui contient le texte "Veuillez saisir une adresse e-mail valide.".
                        Cet extrait de code est un bon exemple de la façon de collecter et de valider les entrées utilisateur dans un formulaire HTML. En utilisant l'attribut type="email", le code est capable de valider l'adresse e-mail de l'utilisateur à l'aide de la validation d'e-mail intégrée au navigateur. De plus, en utilisant l'attribut required, le code est capable de s'assurer que l'utilisateur entre une adresse e-mail valide avant de soumettre le formulaire.
                    */
                    ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control <?= isset($auteur) && $auteur['email'] === false ? 'is-invalid' : '' ?>" id="email" name="email" required value="<?= $auteur['email'] ?? '' ?>">
                        <div class="invalid-feedback">
                            Veuillez saisir une adresse e-mail valide.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="motDePasse" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control <?= isset($auteur) && $auteur['motDePasse'] === false ? 'is-invalid' : '' ?>" id="motDePasse" name="motDePasse" required">
                        <div class="invalid-feedback">
                            Veuillez saisir un mot de passe sécurisé d'au moins 8 caractères, avec au moins une majuscule, une minuscule et un chiffre.
                        </div>
                    </div>
                    <button type="submit" name="envoyer" class="btn btn-secondary">S'inscrire</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                <h2>À Propos</h2>
                <p>Ce site vous permet d'apprendre le PHP en créant et en gérant des articles en ligne.
                    <br><br>
                    Connectez-vous pour commencer à créer et afficher vos propres articles.
                </p>
                <a class="btn btn-outline-secondary" href="/se-connecter">Se connecter</a>
            </div>
        </div>
    </div>


    <footer>
        <img src="assets/img/logo-eni.png"> ENI ECOLE - TP FIL ROUGE - Gestion des articles
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>