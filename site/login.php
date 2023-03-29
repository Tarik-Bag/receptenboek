<?php

// database oproepen
require 'database.php';

// controleer als submit button geklikt is
if (isset($_POST['submit'])) {

    // als geklikt is declareer de variabelen
    $email = $_POST['email'];

    //var_dump($_POST['email']);

    // // SQL query schrijven en bind parameters
    $stmt = $conn->prepare("SELECT * FROM gebruiker WHERE email = :email");
    $stmt->bindParam(':email', $email);

    // query uitvoeren
    $stmt->execute();

    // fetch data aan $gebruiker
    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    if (is_array($gebruiker) && count($gebruiker) > 0) {

        // controleer als wachwoord input gevuld is 
        if (isset($_POST['wachtwoord']) && !empty($_POST['wachtwoord'])) {


            $wachtwoord = $_POST['wachtwoord'];

            if ($gebruiker['wachtwoord'] == $_POST['wachtwoord']) {

                // vul de data van gebruiker op session
                $_SESSION["gebruikerData"] = $gebruiker;

                echo "<script>alert('Logged!'); window.location.href = 'index.php';</script>";
            } else {

                echo "<script>alert('Kan niet inloggen!'); window.location.href = 'login.php';</script>";

                //echo "<script> alert('Kan niet log in!') </script>";

            }
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* CSS styles */
        body {
            background-color: #F7F7F7;
            font-family: Arial, sans-serif;
        }

        .login-box {
            background-color: #FFFFFF;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
            margin: 100px auto;
            padding: 20px;
            width: 300px;
        }

        input[type="text"],
        input[type="password"] {
            border: none;
            border-radius: 3px;
            font-size: 16px;
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
        }

        input[type="submit"] {
            background-color: #0082e6;
            border: none;
            border-radius: 3px;
            color: #FFFFFF;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            padding: 10px;
            width: 100%;
        }
    </style>
</head>

<body>

    <?php include 'assets/nav.php'; ?>

    <div class="login-box">
        <h1>Login</h1>
        <form action="" method="post">
            <input type="text" placeholder="email" name="email" required>
            <input type="password" placeholder="Wachtwoord" name="wachtwoord" required>
            <input type="submit" value="Log In" name="submit">
        </form>
    </div>
</body>

</html>