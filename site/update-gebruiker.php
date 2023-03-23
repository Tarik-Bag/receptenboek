<?php

require 'database.php';

session_start();

if(isset($_SESSION['gebruikerData'])){

    if($_SESSION['gebruikerData']['rol'] == 'admin'){

        echo "<script>alert('Welkom op gebruiker update!');</script>";

    }else{

        echo "<script>alert('U bent niet admin!'); window.location.href = 'dashboard.php';</script>";

    }
}else{

    echo "<script>alert('U bent niet ingelod!'); window.location.href = 'login.php';</script>";

}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM gebruiker WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

$gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["submit"])){

    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $rol = $_POST['rol'];

   

    if (!empty($_POST["naam"])) {

        
        $gebruiker = $_POST["naam"];

        $stmt = $conn->prepare("UPDATE gebruiker SET naam = :naam, achternaam = :achternaam, email = :email,
        wachtwoord = :wachtwoord, rol = :rol
        WHERE id = :id");
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':achternaam', $achternaam);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':wachtwoord', $wachtwoord);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>alert('Data updated!'); window.location.href = 'beheer-gebruiker.php';</script>";
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Gebruiker</title>
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
		<label for="naam">Naam:</label>
		<input type="text" id="naam" name="naam" value="<?php echo $gebruiker["naam"]; ?>">

		<label for="achternaam">Achternaam:</label>
		<input type="text" id="achternaam" name="achternaam" value="<?php echo $gebruiker["achternaam"]; ?>">

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" value="<?php echo $gebruiker["email"]; ?>">

		<label for="wachtwoord">Wachtwoord:</label>
		<input type="text" id="wachtwoord" name="wachtwoord" value="<?php echo $gebruiker["wachtwoord"]; ?>">

		<label for="rol">Rol:</label>
		<select id="rol" name="rol">
			<option value="<?php echo $gebruiker["rol"]; ?>"><?php echo $gebruiker["rol"]; ?></option>
			<option value="admin">Admin</option>
			<option value="gebruiker">Gebruiker</option>
		</select>

		<input type="submit" value="Update" name="submit">
	</form>
</body>
</html>