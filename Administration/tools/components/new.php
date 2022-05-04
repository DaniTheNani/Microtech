<?php

include __DIR__ . '../../../../Application/Database.php';

$db = new database();

$categories = $db->read('categories');

if(isset($_POST['submit'])){
    $img_name = $_FILES['compimage']['name'];
        $img_size = $_FILES['compimage']['size'];
        $tmp_name = $_FILES['compimage']['tmp_name'];
        $error = $_FILES['compimage']['error'];
        if ($error === 0) {
            if ($img_size > 125000) {
                $em = "Túl nagy a kép mérete!";
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png", "jfif");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . "." . $img_ex;
                    $img_upload_path = '../../../files/component-image/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                }
            }
        }
        $data['name'] = $_POST['compname'];
        $data['cat_id'] = $_POST['compcat'];
        $data['image'] = $new_img_name;

        $insertComp = new Database();

        $ExistComp = $insertComp->getItemByValue('components', 'name', $data['name']);

        if ($ExistComp) {
            foreach ($ExistComp as $key) {
                $key['name'] = $data['name'];
            }
            $wrongcomp = "Már van ilyen Alkatrész";
            echo $wrongcomp;
        } else {
            $insertComp->insert('components', $data);
            header("Location:../../administration.php#components");
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
    <title>Micro Tech - Alkatrész módosítás</title>
</head>

<body>
    <section id="modify">
        <div class="modify-border" style="width:30%; left:35%; height:35%">
            <h1>Új Alkatrész felvétele</h1>
            <form method="post" enctype="multipart/form-data">
                <label>Alkatrész:</label>
                <input type="text" name="compname" required><br>
                <label>Kategóriája:</label>
                <select name="compcat" style="width: 25%; position:relative; left: 15%" required>
                    <?php foreach ($categories as $key) : ?>
                        <option value="<?= $key['id'] ?>"><?= $key['name'] ?></option>
                    <?php endforeach; ?>
                </select><br>
                <input type="file" name="compimage" required><br>
                <input type="submit" value="Rögzítés" class="submit" name="submit" >
            </form>
        </div>
    </section>
</body>

</html>