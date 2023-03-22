<?php

session_start();

if(isset($_SESSION['gebruikerData'])){

    session_destroy();

    echo "<script>alert('Logout!'); window.location.href = 'login.php';</script>";
    
}
else{

    echo "<script>alert('Already logout!'); window.location.href = 'login.php';</script>";

}