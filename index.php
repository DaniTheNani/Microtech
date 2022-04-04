<?php
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="files/css/index.css?=<?= rand(1, 12000) ?>">
    <link rel="stylesheet" href="common/css/bootstrap.min.css">
    <link rel="stylesheet" href="common/css/bootstrap-icons.css">
    <script src="common/js/jquery-3.5.1.min.js"></script>
    <script src="common/js/popper.min.js"></script>
    <script src="common/js/bootstrap.min.js"></script>
    <title>Micro Tech - Főoldal</title>
</head>

<body>
    <div class="navbar">
        <ul>
            <li><a href="Login/login.php">Bejelentkezés</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Micro Tech</h1>
        <p>Böngéssz több ezer számítógépes alkatrészek között vagy akár építsd fel a sajátodat!</p>
        <div>
            <a href="#more"><button type="button"><span></span>Részletek</button></a>
        </div>
        <section id="more">
            <h1>Részlet cím</h1>
            <p>Részletesebb információ..</p>
        </section>
    </div>
</body>

</html>