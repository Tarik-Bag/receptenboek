<?php

// database oproepen
require 'database.php';



// controleren als admin is of niet
if(isset($_SESSION['gebruikerData'])){

    if($_SESSION['gebruikerData']['rol'] == 'admin'){

        echo "<script>alert('Welkom op recepten beheerder!');</script>";

    }else{

        echo "<script>alert('U bent niet admin!'); window.location.href = 'dashboard.php';</script>";

    }
}else{

    echo "<script>alert('U bent niet ingelod!'); window.location.href = 'login.php';</script>";

}

// controleer als submit button geklikt is 
if(isset($_POST['submit'])){
    
    // als geklikt is declareer de variabelen
    $titel = $_POST['titel'];
    $afbeelding = $_POST['afbeelding'];
    $duur = $_POST['duur'];
    $menugang = $_POST['menugang'];
    $moeilijkheid = $_POST['moeilijkheid'];
    $instructies = $_POST['instructies'];
    
    // SQL query schrijven
    $stmt = $conn->prepare("INSERT INTO recept (titel, afbeelding, duur, menugang, moeilijkheid, instructies)
    VALUES (:titel, :afbeelding, :duur, :menugang, :moeilijkheid, :instructies)");

    // bind parameters
    $stmt->bindParam(':titel', $titel);
    $stmt->bindParam(':afbeelding', $afbeelding);
    $stmt->bindParam(':duur', $duur);
    $stmt->bindParam(':menugang', $menugang);
    $stmt->bindParam(':moeilijkheid', $moeilijkheid);
    $stmt->bindParam(':instructies', $instructies);

    // query uitvoeren
    $stmt->execute();
    
    echo "<script>alert('Geregistreerd!'); window.location.href = 'beheer-recept.php';</script>";

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }

        form {
            background-color: white;
            padding: 20px;
            width: 50%;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        button[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        button[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <?php include 'assets/nav.php'; ?>

    <form action="" method="post">
		<label for="titel">Titel:</label>
		<input type="text" id="titel" name="titel" placeholder="Voer de titel in">

		<label for="afbeelding">Afbeelding:</label>
		<input type="text" id="afbeelding" name="afbeelding" placeholder="Vul de afbeelding naam in">

		<label for="duur">Duur:</label>
		<input type="text" id="duur" name="duur" placeholder="Vul de duurheid in">

		<label for="menugang">Menugang:</label>
		<select id="menugang" name="menugang" placeholder="Kies de menugang">

			<option value="voorgerecht">Voorgerecht</option>
			<option value="soep">Soep</option>
			<option value="hoofdgerecht">Hoofdgerecht</option>
			<option value="nagerecht">Nagerecht</option>

		</select>

        <label for="moeilijkheid">Moeilijkheid:</label>
		<select id="moeilijkheid" name="moeilijkheid" placeholder="Kies de moeilijksgraad uit 5">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
        
        <label for="instructies">Instructies:</label>
		<input type="textarea" id="instructies" name="instructies" placeholder="Vul de instructies in">

		<input type="submit" value="Register Recept" name="submit">
    </form>
</body>

</html>