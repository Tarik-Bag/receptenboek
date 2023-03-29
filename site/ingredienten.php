<?php

require 'database.php';

$stmt = $conn->prepare("SELECT * FROM ingredient");
$stmt->execute();

// LEFT JOIN aantal_ingredient ON aantal_ingredient.ingredient_id = ingredient.id
// LEFT JOIN recept ON recept.id = aantal_ingredient.recept_id

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$ingredienten = $stmt->fetchAll();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingredienten</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
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

    <?php include 'assets/nav.php'; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Eenheid</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ingredienten as $ingredient) { ?>

                <tr>
                    <td> <?php echo $ingredient["id"] ?> </td>
                    <td> <?php echo $ingredient["naam"] ?> </td>
                    <td> <?php echo $ingredient["eenheid"] ?> </td>
                    <td> <a href="update-ingredient.php?id=<?php echo $ingredient["id"] ?>"> Update Data </a> </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
</body>

</html>