<?php
include __DIR__ . "../../../../Application/Database.php";

if (isset($_POST['submit'])) {
    $data['name'] = $_POST['propname'];

    $insertProp = new Database();

    $ExistProp = $insertProp->getItemByValue('properties', 'name', $data['name']);

    if ($ExistProp) {
        foreach ($ExistProp as $key) {
            $key['name'] = $data['name'];
        }
        $wrongprop = "Már van ilyen tulajdonság";
        echo $wrongprop;
    } else {
        $insertProp->insert('properties', $data);
        header("Location:../../administration.php#properties");
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
    <title>Micro Tech - Kategória módosítás</title>
</head>

<body>
    <section id="modify">
        <div class="modify-border">
            <h1>Tulajdonság</h1>
            <form action="" method="post">
                <label for="propname">Új tulajdonság megadása:</label>
                <input type="text" name="propname" placeholder="Új tulajdonság"><br>
                <input type="submit" value="Rögzítés" class="submit" name="submit">
            </form>
        </div>
    </section>
</body>

</html>