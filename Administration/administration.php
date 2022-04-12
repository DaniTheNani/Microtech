<?php
include __DIR__ . "../../Application/Database.php";
include(__DIR__ . "../../Administration/newcat.php");
include(__DIR__ . "../../Administration/newcomp.php");
include(__DIR__ . "../../Administration/newprop.php");
include(__DIR__ . "../../Administration/newcompprop.php");

session_start();

$db = new Database();
$comp_cat = new Database();
$categories = $db->read('categories');
$components = $db->read('components');
$properties = $db->read('properties');
$cat_prop = new Database();

$newcatsuccess = "";
$newcatnotsuccess = "";
$deletecatsuccess = "";
$deletecatnotsuccess = "";

//inserting new categories

if (isset($_POST['cat-submit'])) {
    $catnamespace = new newcat();
    if($catnamespace->insert_cat($_POST)){
        $newcatsuccess = "Sikeresen rögzítettük";
    }else{
        $newcatnotsuccess = "Nem sikerült rögzítenünk";
    }
}

//inserting new components

if (isset($_POST['comp-submit']) && isset($_FILES['compimage'])) {
    $compnamespace = new newcomp();
    $compnamespace->insert_comp($_POST, $_FILES);
}

//inserting new properties

if (isset($_POST['prop-submit'])) {
    $propnamespace = new newprop();
    $propnamespace->insert_prop($_POST);
}

//inserting new component properties

if (isset($_POST['cat_prop-submit'])) {
    $comppropnamespace = new newcompprop();
    $comppropnamespace->insert_comp_prop($_POST);
}

if (isset($_POST['cat-submit-delete'])) {
    if ($deletecat = $db->delete('categories', $_POST['catid'])) {
        header('Location: #delete-category');
    }
}
if (isset($_POST['comp-submit-delete'])) {
    if ($deletecomp = $db->delete('components', $_POST['compid'])) {
        header('Location: #delete-components');
    }
}
if (isset($_POST['prop-submit-delete'])) {
    if ($deleteprop = $db->delete('properties', $_POST['propid'])) {
        header('Location: #delete-properties');
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../files/css/main.css?=<?= rand(1, 12000) ?>">
    <title>Micro Tech - Adminisztráció</title>
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bx bx-code-alt' style="cursor: pointer;"></i>
            <span class="logo_name" style="cursor: pointer;">Micro Tech</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#home">
                    <i class='bx bx-home'></i>
                    <span class="link_name">Home</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#home">Home</a></li>
                </ul>
            </li>
            <li>
                <a href="#user">
                    <i class='bx bx-user'></i>
                    <span class="link_name">Felhasználó</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#user">Felhasználó</a></li>
                </ul>
            </li>
            <li>
                <a href="../php/explore.php">
                    <i class='bx bx-compass'></i>
                    <span class="link_name">Felfedezés</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../php/explore.php">Felfedezés</a></li>
                </ul>
            </li>
            <div class="top-border">
                <li>
                    <div class="iocn-link">
                        <a href="#new-data">
                            <i class="bi bi-plus"></i>
                            <span class="link_name">Új adat rögzítése</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#new-data">Új adat rögzítése</a></li>
                        <li><a href="#new-category">Kategória</a></li>
                        <li><a href="#new-components">Alkatrész</a></li>
                        <li><a href="#new-properties">Tulajdonságok</a></li>
                        <li><a href="#new-comp_prop">Alkatrész tulajdonságai</a></li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                        <a href="#delete-data">
                            <i class="bi bi-dash"></i>
                            <span class="link_name">Meglévő adatok törlése</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#delete-data">Meglévő adatok törlése</a></li>
                        <li><a href="#delete-category">Kategória</a></li>
                        <li><a href="#delete-components">Alkatrész</a></li>
                        <li><a href="#delete-properties">Tulajdonságok</a></li>
                    </ul>
                </li>
            </div>
            <li>
                <section class="profile-details" id="">
                    <div class="profile-content">
                        <img src="../files/images/user.jpg" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name"><?php echo $_SESSION['fullname']; ?></div>
                        <div class="job"><?php echo $_SESSION['permission']; ?></div>
                    </div>
                    <a href="../php/logout.php"><i class='bx bx-log-out'></i></a>
                </section>
            </li>
        </ul>
    </div>
    <section class="home-section" id="home">
        <h1>Üdvözöljük <span class="red"><?php echo $_SESSION['fullname']; ?></span> az Adminisztrációs felületen!</h1>
    </section>
    <section class="home-section" id="user">
        <div class="user-border">
            <div class="user-data">
                <h1>Felhasználó adatai</h1>
                <ul>
                    <li> Username: <span class="red"><?php echo $_SESSION['username']; ?> </span><br></li>
                    <li> Email: <span class="red"><?php echo $_SESSION['email']; ?> </span><br></li>
                    <li> Jogosultás: <span class="red"><?php echo $_SESSION['permission']; ?></span><br></li>
                </ul>
            </div>
            <div class="user-picture">
                <figure>
                    <img src="../files/images/user.jpg" alt="" class="user-profilepicture"><br>
                    <figcaption class="img-description">
                        Név: <?php echo $_SESSION['fullname']; ?>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>
    <section class="home-section" id="new-data">
        <div class="card">
            <a href="#new-category">
                <div class="card-text">
                    <h2>Kategória</h2>
                    <p>Újabb kategóra felvétele.<br> (cpu, gpu, ram, táp ... etc)</p>
                </div>
            </a>
        </div>
        <div class="card2">
            <a href="#new-components">
                <div class="card-text">
                    <h2>Alkatrész</h2>
                    <p>Újabb alkatrész felvétele. <br>(AMD Ryzen 7 5800X, MSI B450 Tomahawk Max II ... etc)</p>
                </div>
            </a>
        </div>

        <div class="card3">
            <a href="#new-properties">
                <div class="card-text">
                    <h2>Tulajdonságok</h2>
                    <p>Újabb tulajdonság felvétele. <br>(Méret, típus, gyártó, magok száma, memóra méret ... etc)</p>
                </div>
            </a>
        </div>

        <div class="card">
            <a href="#new-comp_prop">
                <div class="card-text">
                    <h5>Alkatrész tulajdonság</h5>
                    <p>Alkatrészekhez való tulajdonságok felvétele <br> (8 magos, 3200mhz, 700w, 8gb ... etc)</p>
                </div>
            </a>
        </div>
    </section>
    <section class="home-section" id="new-category">
        <div class="container">
            <div class="category-box">
                <h1>Új kategoria felvétele</h1>
                <div class="form">
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                        <input type="text" id="catname" class="form_input" name="catname" autocomplete="off" placeholder=" " require>
                        <label for="catname" class="form_label">Kategória</label>
                        <input type="submit" name="cat-submit" value="Rögzítés" class="submit-btn">
                    </form>
                </div>
                <div class="result">
                    <span class="success"><?php echo $newcatsuccess ?></span>
                    <span class="notsuccess"><?php echo $newcatnotsuccess ?></span>
                </div>
            </div>
            <div class="list-box">
                <h5>Jelenlegi kategóriák az adatbázisban</h5>
                <ul>
                    <li>
                        <?php
                        foreach ($categories as $key) :   ?>
                            <?= $key['id'] ?> . <?= $key['name'] ?><br>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="home-section" id="new-components">
        <div class="container">
            <div class="category-box">
                <h1>Új Alkatrész felvétele</h1>
                <div class="form-input" style="width: 20%; left:15%; top:30%;">
                    <form method="post" enctype="multipart/form-data">
                        <label>Alkatrész:</label>
                        <input type="text" name="compname" required><br><br>
                        <label>Kategóriája:</label>
                        <select name="compcat" style="width: 90%" required>
                            <?php foreach ($categories as $key) : ?>
                                <option value="<?= $key['id'] ?>"><?= $key['name'] ?></option>
                            <?php endforeach; ?>
                        </select><br><br>
                        <input type="file" name="compimage" required><br><br>
                        <input type="submit" class="cat-submit" name="comp-submit" value="Rögzítés" style="position: absolute; left: 60%; top:100%;">
                    </form>
                </div>
                <div class="result">

                </div>
            </div>
            <div class="list-box">
                <h5>Jelenlegi alkatrészek az adatbázisban</h5>
                <ul>
                    <li>
                        <?php
                        foreach ($components as $key) :   ?>
                            <?= $key['id'] ?> . <?= $key['name'] ?><br>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="home-section" id="new-properties">
        <div class="container">
            <div class="category-box">
                <h1>Új tulajdonság felvétele</h1>
                <div class="form">
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                        <input type="text" id="propname" class="form_input" name="propname" autocomplete="off" placeholder=" " require>
                        <label for="propname" class="form_label">Tulajdonság</label>
                        <input type="submit" name="prop-submit" value="Rögzítés" class="submit-btn">
                    </form>
                </div>
                <div class="result">
                    <span class="success"><?php echo $newpropsuccess ?></span>
                    <span class="notsuccess"><?php echo $newpropnotsuccess ?></span>
                </div>
            </div>
            <div class="list-box">
                <h5>Jelenlegi tulajdonságok az adatbázisban</h5>
                <ul>
                    <li>
                        <?php
                        foreach ($properties as $key) :   ?>
                            <?= $key['id'] ?> . <?= $key['name'] ?><br>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
    </section>
    <section class="home-section" id="new-comp_prop">
        <div class="comp_cat_container">
            <form method="POST">
                <label for="">Válasszon kategóriát: </label>
                <select name="comp_cat" id="comp_cat" onchange="location = this.value;">
                    <option disabled selected>===Válasszon kategóriát===</option>
                    <?php foreach ($categories as $key) : ?>
                        <option value="#<?= $key['name']; ?>"><?= $key['name']; ?></a></option>
                    <?php endforeach ?>
                </select>
                <button name="cat-submit" class="cat-submit">Választás</button>
            </form>
        </div>
    </section>
    <section class="home-section" id="delete-data">
        <div class="card">
            <a href="#delete-category">
                <div class="card-text">
                    <h2>Kategória</h2>
                    <p>Meglévő kategóra törlése.<br> (cpu, gpu, ram, táp ... etc)</p>
                </div>
            </a>
        </div>
        <div class="card2">
            <a href="#delete-components">
                <div class="card-text">
                    <h2>Alkatrész</h2>
                    <p>Meglévő alkatrész törlése. <br>(AMD Ryzen 7 5800X, MSI B450 Tomahawk Max II ... etc)</p>
                </div>
            </a>
        </div>
        <div class="card3">
            <a href="#delete-properties">
                <div class="card-text">
                    <h2>Tulajdonságok</h2>
                    <p>Meglévő tulajdonság törlése. <br>(Méret, típus, gyártó, magok száma, memóra méret ... etc)</p>
                </div>
            </a>
        </div>
    </section>
    <section class="home-section" id="delete-category">
        <div class="container">
            <div class="category-box">
                <h1>Meglévő kategoria törlése</h1>
                <div class="form">
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                        <input type="text" id="catname" class="form_input" name="catid" autocomplete="off" placeholder=" " require>
                        <label for="catid" class="form_label">Kategória-id</label>
                        <input type="submit" name="cat-submit-delete" value="Törlés" class="submit-btn">
                    </form>
                </div>
                <div class="result">
                    <span class="success"><?php echo $deletecatsuccess ?></span>
                    <span class="notsuccess"><?php echo $deletecatnotsuccess ?></span>
                </div>
            </div>
            <div class="list-box">
                <h5>Jelenlegi kategóriák az adatbázisban</h5>
                <ul>
                    <li>
                        <?php
                        foreach ($categories as $key) :   ?>
                            <?= $key['id'] ?> . <?= $key['name'] ?><br>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="home-section" id="delete-components">
        <div class="container">
            <div class="category-box" style="width: 70%;">
                <h1>Meglévő alkatrész törlése</h1>
                <div class="form">
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                        <input type="text" id="compname" class="form_input" name="compid" autocomplete="off" placeholder=" " require>
                        <label for="compid" class="form_label">Alkatrész-id</label>
                        <input type="submit" name="comp-submit-delete" value="Törlés" class="submit-btn">
                    </form>
                </div>
                <div class="result">
                    <span class="success"><?php echo $deletecompsuccess ?></span>
                    <span class="notsuccess"><?php echo $deletecompnotsuccess ?></span>
                </div>
            </div>
            <div class="list-box">
                <h5>Jelenlegi alkatrészek az adatbázisban</h5>
                <ul>
                    <li>
                        <?php
                        foreach ($components as $key) :   ?>
                            <?= $key['id'] ?> . <?= $key['name'] ?><br>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="home-section" id="delete-properties">
        <div class="container">
            <div class="category-box">
                <h1>Meglévő tulajdonság törlése</h1>
                <div class="form">
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                        <input type="text" id="propname" class="form_input" name="propid" autocomplete="off" placeholder=" " require>
                        <label for="propid" class="form_label">Tulajdonság-id</label>
                        <input type="submit" name="prop-submit-delete" value="Törlés" class="submit-btn">
                    </form>
                </div>
                <div class="result">
                    <span class="success"><?php echo $deletepropsuccess ?></span>
                    <span class="notsuccess"><?php echo $deletepropnotsuccess ?></span>
                </div>
            </div>
            <div class="list-box">
                <h5>Jelenlegi tulajdonságok az adatbázisban</h5>
                <ul>
                    <li>
                        <?php
                        foreach ($properties as $key) :   ?>
                            <?= $key['id'] ?> . <?= $key['name'] ?><br>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <?php foreach ($categories as $key) : ?>
        <section class="home-section" id="<?= $key['name'] ?>">
            <div class="container">
                <div class="category-box" style="width: 100%; text-align:center;">
                    <h1><?= $key['name'] ?></h1>
                    <form method="post">
                        <select name="comp_id">
                            <?php foreach ($comp_cat->getItemByValue('components', 'cat_id', $key['id']) as $result) : ?>
                                <option value="<?= $result['id'] ?>"><?= $result['name'] ?></option>
                            <?php endforeach; ?>
                        </select><br>
                        <div class="form-input">
                            <?php foreach ($cat_prop->cat_prop_inner($key['id']) as $result) : ?>
                                <input type="text" hidden name="prop_id" value=<?= $result['id'] ?>>
                                <label><?= $result['name'] ?></label>
                                <input type="text" name="value" required><br>
                            <?php endforeach ?>
                        </div>
                        <button name="cat_prop-submit" class="cat-submit" style="bottom: 10%; right:40%;">Rögzítés</button>
                    </form>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-code-alt");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
        let sidebarBtnn = document.querySelector(".logo_name");
        sidebarBtnn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>
</body>

</html>