<?php

require_once '../Application/Database.php';
$db = new Database();
$db->delete('workers', $_GET['id']);
header('Location: index.php');
?>
