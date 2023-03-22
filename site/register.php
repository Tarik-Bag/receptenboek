<?php

// database oproepen
require 'database.php';

// controleer als submit button geklikt is 
if(isset($_POST['submit'])){
    
    // als geklikt is declareer de variabelen
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    
    // SQL query schrijven
    $stmt = $conn->prepare("INSERT INTO gebruiker (naam, achternaam, email, wachtwoord, rol)
    VALUES (:naam, :achternaam, :email, :wachtwoord, 'gebruiker')");

    // bind parameters
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':wachtwoord', $wachtwoord);

    // query uitvoeren
    $stmt->execute();
    
    echo "<script>alert('Registered!'); window.location.href = 'login.php';</script>";

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
    <form action="" method="post">
        <label for="naam">Naam</label>
        <input type="text" id="naam" name="naam" placeholder="Vul uw naam in" >

        <label for="achternaam">Achternaam</label>
        <input type="text" id="achternaam" name="achternaam" placeholder="Vul uw achternaam in" >

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Voer uw e-mailadres in" >

        <label for="wachtwoord">Wachtwoord</label>
        <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Voer uw wachtwoord in" >

        <button type="submit" name="submit">Register</button>
    </form>
</body>

</html>