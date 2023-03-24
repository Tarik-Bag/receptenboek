<?php

require 'database.php';

session_start();

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


$stmt = $conn->prepare("SELECT *, gebruiker.id AS gebruiker_ID FROM recept 
LEFT JOIN gebruiker ON gebruiker.id = recept.gebruiker_id");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$recepten = $stmt->fetchAll();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepten Beheerder</title>
    <style>
		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 20px;
		}

		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		img {
			max-width: 100%;
			height: auto;
		}

		select {
			margin: 0;
			padding: 0;
			font-size: 100%;
			appearance: none;
			border: none;
			background-color: transparent;
		}

		textarea {
			width: 100%;
			height: 100px;
			resize: vertical;
		}
	</style>
</head>
<body>
    <table>
        <thead>
            <tr>
				<th>Titel</th>
				<th>Afbeelding</th>
				<th>Duur</th>
				<th>Menugang</th>
				<th>Moeilijkheid</th>
				<th>Instructies</th>
				<th>Gebruiker Naam</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
        </thead>

        <tbody>

            <?php foreach ($recepten as $recept) { ?>

                <tr>
                    <td> <?php echo $recept["titel"] ?> </td>
                    <td> <?php echo $recept["afbeelding"] ?> </td>
                    <td> <?php echo $recept["duur"] ?> </td>
                    <td> <?php echo $recept["menugang"] ?> </td>
                    <td> <?php echo $recept["moeilijkheid"] ?> </td>
                    <td> <?php echo $recept["instructies"] ?> </td>
                    <td> <?php echo $recept["naam"] ?> </td>
                    <td> <a href="update-recept.php?id=<?php echo $recept["id"] ?>"> Update Data </a> </td>
                    <td> <a href="delete-recept.php?id=<?php echo $recept["id"] ?>"> Delete Data </a> </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
</body>
</html>
