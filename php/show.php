<?php

include __DIR__ . "../../Application/Database.php";
$db = new Database();
$componentName = $db->getItemByValue('components', 'id', $_GET['id']);
$properties = new Database();
$comp_prop = new Database();
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
    <link rel="stylesheet" href="../css/show.css?=<?= rand(1, 12000) ?>">
    <title>Micro Tech - Alkatrészek</title>
</head>

<body>
    <section class="home-section" id="show">
        <div class="component-result-border">
            <table>
                <tr>
                    <?php foreach ($componentName as $key => $value) : ?>
                        <?= $value['name']; ?><br>
                    </tr>
                    <?php foreach ($comp_prop->getItemByValue('comp_prop', 'comp_id', $_GET['id']) as $row => $compValue) : ?>
                        <tr>
                            <?= $compValue['value'] ?><br>
                            <?php foreach ($properties->read('properties') as $key => $propValue) : ?>
                    </tr>
        <?php endforeach;
                        endforeach;
                    endforeach; ?>
            </table>
        </div>
    </section>
</body>

</html>