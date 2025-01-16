<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Rubik:wght@700&display=swap" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
		integrity="sha384-<your-sha384-hash>" crossorigin="anonymous">
	<style>
		body {
			font-family: 'Poppins', sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f4f4f4;
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}

		header {
			background-color: #333;
			color: #fff;
			padding: 15px;
			text-align: center;
		}

		main {
			max-width: 800px;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			text-align: center;
		}

		h1 {
			color: red;
		}

		button {
			background-color: #333;
			color: #fff;
			padding: 10px 15px;
			border: none;
			cursor: pointer;
		}

		/* Style de la fenêtre modale */
		.modal {
			display: none;
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
			z-index: 1000;
		}

		.close {
			position: absolute;
			top: 260px;
			right: 465px;
			cursor: pointer;
		}
	</style>
</head>

<body>

	<header>
		<h1>
			<?= e($title) ?>
		</h1>
	</header>

	<main>
		<!-- La fenêtre modale -->
		<div>
			<span class="close" onclick="closeModal()">&times;</span>
			<p id="erreur">
				<strong>
					<?= e($message) ?>
				</strong>
			</p>
		</div>

		<?php require "view_end.php"; ?>
	</main>

	<script>

		// Fonction pour fermer la fenêtre modale et rediriger vers la page précédente
		function closeModal() {
			window.history.back();
		}

	</script>
</body>

</html>