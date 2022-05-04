<?php

require_once '../../../Application/Database.php';
$db = new Database();

if(isset($_GET['id'])){
    $db->delete('properties', $_GET['id']);
    header("Location:../../administration.php#properties");
}

?>
