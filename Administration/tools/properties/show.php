<?php

include __DIR__ . "../../../../Application/Database.php";
$db = new Database();
$properties = $db->readOne('properties', $_GET['id']);

$cat_prop = $db->prop_cat_inner($_GET['id']);

?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../files/css/show.css?=<?= rand(1, 12000) ?>">
    <title>Micro Tech - Kategória megtekintés</title>
</head>

<body>
    <section id="show">
        <div class="component-result-border">
            <div class="component-result-image">
                <?php foreach ($properties as $key => $value) : ?>
                    <span class="cat_name">Tulajdonság neve: <?= $value['name']; ?></span>
                <?php endforeach; ?>
            </div>
            <div class="component-result">
            <span style="color:red;">A hozzá tartozó kategóriák:</span>
                <ul>
                    <?php foreach ($cat_prop as $key => $result) : ?>
                        <li><span style="color: whitesnow;"><?= $result['name'] ?></span><br></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
</body>

</html>