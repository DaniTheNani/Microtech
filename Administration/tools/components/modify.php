<?php

include __DIR__ . "../../../../Application/Database.php";
$db = new Database();

$id = $_GET['id'];

$components = $db->readOne('components', $_GET['id']);

if (isset($_POST['submit'])) {
    $db->singleupdate('components', 'name', $_POST['changecomp'], $_GET['id']);
    header("Location:../../administration.php#components");
}

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
    <link rel="stylesheet" href="../../../files/css/modify.css?=<?= rand(1, 12000) ?>">
    <title>Micro Tech - Alkatrész módosítás</title>
</head>

<body>
    <section id="modify">
        <div class="modify-border">
            <h1>Alkatrész</h1>
            <form action="" method="post">
                <label for="changeprop">Változtatni kívánt alkatrész:</label>
                <?php foreach ($components as $key => $result) : ?>
                    <input type="text" name="changecomp" placeholder="<?= $result['name'] ?>"><br>
                <?php endforeach; ?>
                <input type="submit" value="Változtatás" class="submit" name="submit">
            </form>
        </div>
    </section>
</body>

</html>