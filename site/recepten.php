<?php

require 'database.php';


$stmt = $conn->prepare("SELECT *, recept.id AS recept_ID, gebruiker.id AS gebruiker_ID FROM recept 
LEFT JOIN gebruiker ON gebruiker.id = recept.gebruiker_id");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$recepten = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Recepten</title>
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include 'assets/nav.php'; ?>

    <br>

    <div class="menu">

        <?php foreach ($recepten as $recept) { ?>

            <div class="food-items">
                <img src="images/<?php echo $recept["afbeelding"] ?>">
                <div class="details">
                    <div class="details-sub">
                        <h5 id="titel"> <i> <?php echo $recept["titel"] ?> </i> </h5>
                        <h5 class="price" id="moeilijkheid"> Moeilijkheid(1-5): <?php echo $recept["moeilijkheid"] ?> </h5>
                    </div>
                    <p><?php echo $recept["instructies"] ?></p>
                    <!-- <button id="button">  Recept  </button> -->
                    <a href="recept.php?id=<?php echo $recept["recept_ID"] ?>"> <input type="button" value="Recept" id="submit"> </a>
                </div>
            </div>

        <?php } ?>
    </div>
</body>

</html>