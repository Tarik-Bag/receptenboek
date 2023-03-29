<?php

require 'database.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM recept WHERE recept.id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

$recept = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT *, recept.id AS recept_ID, ingredient.naam AS ingredient_naam
FROM recept
LEFT JOIN aantal_ingredient ON aantal_ingredient.recept_id = recept.id
LEFT JOIN ingredient ON ingredient.id = aantal_ingredient.ingredient_id
WHERE recept.id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

$ingredienten = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/recept-style.css">
	<title><?php echo $recept["titel"] ?></title>
</head>

<body>


	<main>

		<div class="button-container">
			<a href="recepten.php"> Terug </a>
		</div>

		<br><br>

		<section id="recipe-intro">
			<h2><?php echo $recept["titel"] ?></h2>
			<img src="images/<?php echo $recept["afbeelding"] ?>">
		</section>


		<div class="container">
			<div class="duur">Duur: <?php echo $recept["duur"] ?> minuten</div>
			<div class="menugang">Menugang: <?php echo $recept["menugang"] ?></div>
			<div class="moeilijkheid">Moeilijkheid(1-5): <?php echo $recept["moeilijkheid"] ?></div>
		</div>


		<section id="recipe-ingredients">
			<h3>Ingredienten</h3>
			<ul>
				<?php foreach($ingredienten as $ingredient){ ?>

					<li> <?php echo $ingredient["aantal"] . " " .  $ingredient["eenheid"] . " " . $ingredient["ingredient_naam"]; ?> </li>

				<?php } ?>
			</ul>
		</section>

		<section id="recipe-instructions">
			<h3>Instructions</h3>
			<?php echo $recept["instructies"] ?>
		</section>
	</main>
</body>

</html>