<?php


session_start();



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Micro Tech - Explore</title>
</head>

<body>
    <div class="container">
        <div class="split left">
            <h1>Alkatrészek</h1>
            <a href="component.php" class="button">Részletek</a>
        </div>
        <div class="split right">
            <h1>Játékok</h1>
            <a href="game.php" class="button">Részletek</a>
        </div>
        <?php
        if ($_SESSION['permission'] == "Weblap Tervező") {
            echo ' <div class="nav-admin">
            <a href="administration.php"><span>Belépés mint Adminisztrátor</span></a>
            </div>';
        }
        ?>
    </div>
</body>

</html>