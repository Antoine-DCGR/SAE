<?php require "view_begin.php"; ?>

<style>
    .containere {
        max-width: 600px;
        margin: 150px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .containere form {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
    }

    .containere button {
        margin-bottom: 10px;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
        background-color: #293358;
        color: #fff;
        border: none;
        border-radius: 4px;
    }

    .containere button:hover {
        background-color: #0056b3;
    }
</style>

<div class="containere">
    <h1>Quelle personne voulez-vous ajouter ?</h1>

    <form action="?controller=set&&action=ajout" method="POST">
        <button type="submit" name="poste" value="Enseignant">Enseignant</button>
        <button type="submit" name="poste" value="Secrétaire">Secrétaire</button>
    </form>
</div>

<?php require "view_end.php"; ?>