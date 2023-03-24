<?php

require "database.php";

$rcp_id = $_GET['id'];

// echo var_dump($gbr_id); die;

$delete_rcp = $conn->prepare("DELETE FROM recept WHERE id = :id");
$delete_rcp->bindParam(':id', $rcp_id);
$delete_rcp->execute();

if ($delete_rcp->execute()) {
    echo "<script>alert('Verwijderd!'); window.location.href = 'beheer-recept.php';</script>";
}



?>