<?php

require 'database.php';

session_start();

if(isset($_SESSION['gebruikerData'])){

    if($_SESSION['gebruikerData']['rol'] == 'admin'){

        echo "<script>alert('Welkom op gebruiker beheerder!');</script>";

    }else{

        echo "<script>alert('U bent niet admin!'); window.location.href = 'dashboard.php';</script>";

    }
}else{

    echo "<script>alert('U bent niet ingelod!'); window.location.href = 'login.php';</script>";

}


$stmt = $conn->prepare("SELECT * FROM gebruiker");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$gebruikers = $stmt->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruiker Beheerder</title>
    <style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
			border: 1px solid black;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>
    <table>
		<thead>
			<tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Achternaam</th>
            <th>Email</th>
            <th>Wachtwoord</th>
            <th>Rol</th>
            <th>Update</th>
			</tr>
		</thead>
		<tbody>
            <?php foreach ($gebruikers as $gebruiker) { ?>

                <tr>
                    <td> <?php echo $gebruiker["id"] ?> </td>
                    <td> <?php echo $gebruiker["naam"] ?> </td>
                    <td> <?php echo $gebruiker["achternaam"] ?> </td>
                    <td> <?php echo $gebruiker["email"] ?> </td>
                    <td> <?php echo $gebruiker["wachtwoord"] ?> </td>
                    <td> <?php echo $gebruiker["rol"] ?> </td>
                    <td> <a href="update-gebruiker.php?id=<?php echo $gebruiker["id"] ?>"> Update Data </a> </td>
                </tr>

            <?php } ?>
		</tbody>
	</table>
</body>
</html>