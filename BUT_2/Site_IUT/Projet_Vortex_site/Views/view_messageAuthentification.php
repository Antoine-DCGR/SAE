<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Rubik:wght@700&display=swap" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
		integrity="sha384-<your-sha384-hash>" crossorigin="anonymous">

</head>

<body>


	<h1>
		<?= e($title) ?>
	</h1>

	<p id="erreur">
		<strong>
			<?= e($message) ?>
		</strong>
	</p>



	<?php require "view_end.php"; ?>