<?php

require 'database.php';

session_start();

// controleren als admin is of niet
if(isset($_SESSION['gebruikerData'])){

    if($_SESSION['gebruikerData']['rol'] == 'admin'){

        echo "<script>alert('Welkom op recepten update!');</script>";

    }else{

        echo "<script>alert('U bent niet admin!'); window.location.href = 'dashboard.php';</script>";

    }
}else{

    echo "<script>alert('U bent niet ingelod!'); window.location.href = 'login.php';</script>";

}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT *, gebruiker.id AS gebruiker_ID 
FROM recept 
LEFT JOIN gebruiker ON gebruiker.id = recept.gebruiker_id
WHERE recept.id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

$recept = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($recept); die;

if (isset($_POST["submit"])){
	
	
	$titel = $_POST['titel'];
    $afbeelding = $_POST['afbeelding'];
    $duur = $_POST['duur'];
    $menugang = $_POST['menugang'];
    $moeilijkheid = $_POST['moeilijkheid'];
    $instructies = $_POST['instructies'];

    if (!empty($_POST["titel"])) {

		
		$recept = $_POST["titel"];
		
        $stmt = $conn->prepare("UPDATE recept SET titel = :titel, afbeelding = :afbeelding, duur = :duur,
        menugang = :menugang, moeilijkheid = :moeilijkheid, instructies = :instructies 
        WHERE id = :id");
        $stmt->bindParam(':titel', $titel);
        $stmt->bindParam(':afbeelding', $afbeelding);
        $stmt->bindParam(':duur', $duur);
        $stmt->bindParam(':menugang', $menugang);
        $stmt->bindParam(':moeilijkheid', $moeilijkheid);
        $stmt->bindParam(':instructies', $instructies);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>alert('Data updated!'); window.location.href = 'beheer-recept.php';</script>";
        
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Recept</title>
    <style>
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		label, input {
			margin: 8px;
		}

		input[type="submit"] {
			padding: 8px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
    <form action="" method="post">
		<label for="titel">Titel:</label>
		<input type="text" id="titel" name="titel" value="<?php echo $recept["titel"]; ?>">

		<label for="afbeelding">Afbeelding:</label>
		<input type="text" id="afbeelding" name="afbeelding" value="<?php echo $recept["afbeelding"]; ?>">

		<label for="duur">Duur:</label>
		<input type="email" id="duur" name="duur" value="<?php echo $recept["duur"]; ?>">

		<label for="menugang">Menugang:</label>
		<select id="menugang" name="menugang">

			<option value="<?php echo $recept["menugang"]; ?>"><?php echo $recept["menugang"]; ?></option>
			<option value="voorgerecht">Voorgerecht</option>
			<option value="soep">Soep</option>
			<option value="hoofdgerecht">Hoofdgerecht</option>
			<option value="nagerecht">Nagerecht</option>

		</select>

        <label for="moeilijkheid">Moeilijkheid:</label>
		<select id="moeilijkheid" name="moeilijkheid">
			<option value="<?php echo $recept["moeilijkheid"]; ?>"><?php echo $recept["moeilijkheid"]; ?></option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
        
        <label for="instructies">Instructies:</label>
		<input type="textarea" id="instructies" name="instructies" value="<?php echo $recept["instructies"]; ?>">

		<input type="submit" value="Update" name="submit">
	</form>
</body>
</html>