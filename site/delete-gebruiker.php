<?php

require "database.php";

$gbr_id = $_GET['id'];

// echo var_dump($gbr_id); die;

$delete_gbr = $conn->prepare("DELETE FROM gebruiker WHERE id = :id");
$delete_gbr->bindParam(':id', $gbr_id);
$delete_gbr->execute();

if ($delete_gbr->execute()) {
    echo "<script>alert('Verwijderd!'); window.location.href = 'beheer-gebruiker.php';</script>";
}



?>