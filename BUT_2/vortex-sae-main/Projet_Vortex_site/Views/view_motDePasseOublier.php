<?php require "view_begin.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 0;
    }

    h1 {
        color: #007bff;
    }

    .container {
        max-width: 800px;
        margin: 150px auto;
        padding: 60px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    p {
        line-height: 1.6;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <h1>Mot de passe oublié</h1>

    <p>Veuillez contacter l'adresse suivante afin de pouvoir changer votre mot de passe : <a
            href="mailto:exemple@gmail.com">vortex.topaze@gmail.com</a></p>
    <p>Révenir sur la page de connexion : <a href="?controller=authentification&&action=accueil">Authentification</a>
    </p>
</div>

<?php require "view_end.php"; ?>