<?php

require 'database.php';

$stmt = $conn->prepare("SELECT *, recept.id AS recept_ID, gebruiker.id AS gebruiker_ID FROM recept 
LEFT JOIN gebruiker ON gebruiker.id = recept.gebruiker_id
ORDER BY duur DESC");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$recepten_duurheid = $stmt->fetchAll();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specials</title>
    <style>
        button {
            background-color: #3c86be;
            border: none;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            width: 180px;
            cursor: pointer;
        }


        .buttons {
            position: fixed;
            left: 40%;
            
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 60px;
        }

        th,
        td {
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
    

    <form action="" method="post">

        <div class="buttons">

            <a href="specials.php"><button type="submit" name="duurheid"> Duurheid Lijst </button></a>
            <a href="specials.php"><button type="submit" name="makkelijkheid"> Makkelijkheid Lijst </button></a>
            <a href="specials.php"><button type="submit" name="ingredienten"> Meest Ingredienten Lijst </button></a>

        </div>

    </form>

    <?php if(isset($_POST['duurheid'])){ ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
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

                <?php foreach ($recepten_duurheid as $recept) { ?>

                    <tr>
                        <td> <?php echo $recept["recept_ID"] ?> </td>
                        <td> <?php echo $recept["titel"] ?> </td>
                        <td> <?php echo $recept["afbeelding"] ?> </td>
                        <td> <?php echo $recept["duur"] ?> </td>
                        <td> <?php echo $recept["menugang"] ?> </td>
                        <td> <?php echo $recept["moeilijkheid"] ?> </td>
                        <td> <?php echo $recept["instructies"] ?> </td>
                        <td> <?php echo $recept["naam"] ?> </td>
                        <td> <a href="update-recept.php?id=<?php echo $recept["recept_ID"] ?>"> Update Data </a> </td>
                        <td> <a href="delete-recept.php?id=<?php echo $recept["recept_ID"] ?>"> Delete Data </a> </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>

    <?php } ?>
</body>

</html>