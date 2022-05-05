<?php
include __DIR__ . "../../../../Application/Database.php";

if (isset($_POST['submit'])) {
    $data['name'] = $_POST['catname'];

    $data['category'] = $_POST['selectedcat'];

    $insertCat = new Database();

    $ExistCat = $insertCat->getItemByValue('categories', 'name', $data['name']);

    if ($ExistCat) {
        foreach ($ExistCat as $key) {
            $key['name'] = $data['name'];
        }
        $wrongcat = "Már van ilyen kategória";
        echo $wrongcat;
    } else {
        $insertCat->insert('categories', $data);
        header("Location:../../administration.php#categories");
    }
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
    <title>Micro Tech - Új kategória</title>
</head>

<body>
    <section id="modify">
        <div class="modify-border" style="height: 25%;">
            <h1>Kategória</h1>
            <form action="" method="post">
                <label for="catname">Új kategória megadása:</label>
                <input type="text" name="catname" placeholder="Új kategória"><br>
                <select name="selectedcat" style="left:44%;">
                    <option value="Alkatrész">Alkatrész</option>
                    <option value="Játék">Játék</option>
                </select><br>
                <input type="submit" value="Rögzítés" class="submit" name="submit">
            </form>
        </div>
    </section>
</body>

</html>