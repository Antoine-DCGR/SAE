<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        p {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #293358;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php require "view_begin.php"; ?>

    <form action="?controller=set&&action=modifier" method="POST">
        <h1>Modification</h1>

        <p>
            Identifiant de la personne:
            <input name="id" type="number" value="<?= e($personne['id_personne']) ?>" readonly>
        </p>

        <p>
            Nom:
            <input name="nom" type="text" value="<?= e($personne['nom']) ?>">
        </p>

        <p>
            Prénom:
            <input name="prenom" type="text" value="<?= e($personne['prenom']) ?>">
        </p>

        <p>
            Email:
            <input name="email" type="text" value="<?= e($personne['email']) ?>">
        </p>

        <p>
            Mot de passe:
            <input name="mdp" type="text" value="<?= e($personne['motdepasse']) ?>">
        </p>

        <?php if ($role == "Enseignant" || $role == "Chef de département" || $role == "Équipe de direction"): ?>
            <p>
                Catégorie:<br />
                <?php foreach ($cat as $val): ?>
                    <label>
                        <input name="categorie" type="radio" value="<?= e($val["id_categorie"]) ?>" <?php if ($val["id_categorie"] == $categorie["id_categorie"])
                              echo 'checked'; ?>>
                        <?= e($val["siglecat"]) ?>
                    </label>
                <?php endforeach ?>
            </p>
        <?php endif; ?>

        <?php if ($role == "Enseignant" || $role == "Équipe de direction"): ?>
            <p>
                Est-il assigné à l'équipe de direction ?<br />
                <label>
                    <input name="choixEquipe" type="radio" value="oui" <?php if ($role == "Équipe de direction")
                        echo 'checked'; ?>>
                    Oui
                </label>
                <label>
                    <input name="choixEquipe" type="radio" value="non" <?php if ($role !== "Équipe de direction")
                        echo 'checked'; ?>>
                    Non
                </label>
            </p>
        <?php endif; ?>

        <p>
            <input type="submit" />
        </p>
    </form>

    <?php require "view_end.php"; ?>
</body>

</html>