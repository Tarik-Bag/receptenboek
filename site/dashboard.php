<?php

require 'database.php';

// controleren als ingelogd is of niet
if(isset($_SESSION['gebruikerData'])){

    echo "<script>alert('Welkom op dashboard!');</script>";
    
}else{

    echo "<script>alert('U bent niet ingelod!'); window.location.href = 'login.php';</script>";

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<?php include 'assets/nav.php'; ?>

    <table>
        <tbody>
            <tr>
                <td> 
                <a href="beheer-gebruiker.php" <? if(isset($_SESSION['gebruikerData'])){
                    
                    if($_SESSION['gebruikerData']['rol'] == "gebruiker"){
                        echo "hidden";
                    } 
                } ?> > Gebruiker Beheer </a> </td>
                <td><br>
                <a href="register-recept.php" <? if(isset($_SESSION['gebruikerData'])){
                    
                    if($_SESSION['gebruikerData']['rol'] == "gebruiker"){
                        echo "hidden";
                    } 
                } ?> > Recept Register </a> </td>
                <td><br><br>
                <a href="beheer-recept.php" <? if(isset($_SESSION['gebruikerData'])){
                    
                    if($_SESSION['gebruikerData']['rol'] == "gebruiker"){
                        echo "hidden";
                    } 
                } ?> > Recept Beheer
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>