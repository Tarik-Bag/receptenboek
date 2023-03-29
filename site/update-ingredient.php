<?php

require 'database.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM ingredient WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

$ingredient = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($recept); die;

if (isset($_POST["submit"])) {


    $naam = $_POST['naam'];

    if (!empty($_POST["naam"])) {


        $ingredient = $_POST["naam"];

        $stmt = $conn->prepare("UPDATE ingredient SET naam = :naam WHERE id = :id");
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>alert('Data updated!'); window.location.href = 'ingredienten.php';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Ingredient</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label,
        input {
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

    <?php include 'assets/nav.php'; ?>

    <form action="" method="post">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" value="<?php echo $ingredient["naam"]; ?>">

        <input type="submit" value="Update" name="submit">
    </form>
</body>

</html>