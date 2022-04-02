<?php

include '/App/lib/autoload.php';

use App\Database;

$componentName = new \App\Models\Components;
$componentName = $componentName->getItemById($_GET['id']);
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
                    <?php foreach ($adatok as $key => $value) : ?>
                <tr>
                    <td><?= $value['prop']; ?></td>
                    <td><?= $value['value']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tr>
            </table>
        </div>
    </section>
</body>

</html>