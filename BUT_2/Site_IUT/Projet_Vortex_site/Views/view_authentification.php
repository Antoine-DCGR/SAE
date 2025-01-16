<?php
require "view_begin.php";
?>
<title>Authentification</title>
<link rel="stylesheet" href="Contenu/css/Style.css" />

</head>

<body class="body">

    <div class="logo-container">
        <img src="Contenu/im/ss.webp" alt="Site Logo">
    </div>
    <div class="containers">
        <form action="?controller=authentification&&action=connexion" method="post" id="myForm">
            <h1>Identification</h1><br>
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Identifiant" name="id">
            </div><br>
            <div class="input-container">
                <i class="fas fa-lock"></i> <!-- Lock icon -->
                <input type="password" placeholder="Mot de passe" name="password">
            </div>
            <div id="error-container"></div>

            <div class="psw">
                <a href="?controller=authentification&&action=mdpOublier">
                    <p>Mot de passe oubliée</p>
                </a>
            </div>

            <br>
            <div class="button-container">
                <button type="submit" value="S'identifier">S'identifier</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Récupérer les messages d'erreur PHP
            var errorMessages = <?php echo json_encode(isset($data['errorMessages']) ? $data['errorMessages'] : []); ?>;
            var errorContainer = document.getElementById('error-container');

            // Fonction pour afficher la fenêtre pop-up avec le message d'erreur
            function showErrorMessages(messages) {
                for (var i = 0; i < messages.length; i++) {
                    var errorElement = document.createElement('div');
                    errorElement.className = 'error-message';
                    errorElement.textContent = messages[i];
                    errorElement.style.color = 'red'; // Couleur rouge
                    errorElement.style.fontSize = 'small'; // Taille de police petite
                    errorElement.style.marginTop = '30px'; // Marge en haut
                    errorContainer.appendChild(errorElement);
                }
            }

            // Afficher les messages d'erreur s'il y en a
            if (errorMessages.length > 0) {
                showErrorMessages(errorMessages);
            }
        });
    </script>




    <?php

    require "view_end.php";




