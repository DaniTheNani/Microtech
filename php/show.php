<?php

include '/App/lib/autoload.php';

use App\Database;

session_start();
$componentName = new \App\Models\Components;
$componentName = $componentName->getItemById($_GET['id']);
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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