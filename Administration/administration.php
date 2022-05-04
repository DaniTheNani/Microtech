<?php

$con = new PDO("mysql:host=localhost;dbname=microtech", 'root', '');

include __DIR__ . "../../Application/Database.php";

session_start();

$db = new Database();
$comp_cat = new Database();
$categories = $db->read('categories');
$components = $db->read('components');
$properties = $db->read('properties');
$cat_prop = new Database();

//inserting new component properties

if (isset($_POST['cat_prop-submit'])) {
    $comppropnamespace = new newcompprop();
    $comppropnamespace->insert_comp_prop($_POST);
}

if (isset($_POST['submit-search'])) {
    $search = $_POST['search'];
    $search = $con->prepare("SELECT * FROM categories WHERE name = '$search'");

    $search->setFetchMode(PDO::FETCH_OBJ);
    $search->execute();

    if ($row = $search->fetch()) {
?>
        <div class="searcher-result">
            <?= $row->name ?>
            <a href="tools/categories/deletecat.php?id='<?= $row['id']; ?>'"><button id="delete" name="delete">Törlés</button></a>
            <a href="tools/categories/modifycat.php?id='<?= $row['id']; ?>'"><button id="modify" name="modify">Szerkesztés</button></a>
            <a href="tools/categories/show.php?id='<?= $row['id']; ?>'"><button id="inspect" name="inspect">Megtekintés</button></a>
        </div>

    <?php
    } else {
        echo '<script>alert("valami")</script>';
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
                            <i class="bi bi-cloud"></i>
                            <span class="link_name">Új adat rögzítése</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#new-data">Jelenlegi adatok az adatbázisban</a></li>
                        <li><a href="#categories">Kategória</a></li>
                        <li><a href="#components">Alkatrész</a></li>
                        <li><a href="#properties">Tulajdonságok</a></li>
                        <li><a href="#comp_prop">Alkatrész tulajdonságai</a></li>
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
            <a href="#categories">
                <div class="card-text">
                    <h2>Kategória</h2>
                    <p>Újabb kategóra felvétele.<br> (cpu, gpu, ram, táp ... etc)</p>
                </div>
            </a>
        </div>
        <div class="card2">
            <a href="#components">
                <div class="card-text">
                    <h2>Alkatrész</h2>
                    <p>Újabb alkatrész felvétele. <br>(AMD Ryzen 7 5800X, MSI B450 Tomahawk Max II ... etc)</p>
                </div>
            </a>
        </div>

        <div class="card3">
            <a href="#properties">
                <div class="card-text">
                    <h2>Tulajdonságok</h2>
                    <p>Újabb tulajdonság felvétele. <br>(Méret, típus, gyártó, magok száma, memóra méret ... etc)</p>
                </div>
            </a>
        </div>

        <div class="card">
            <a href="#comp_prop">
                <div class="card-text">
                    <h5>Alkatrész tulajdonság</h5>
                    <p>Alkatrészekhez való tulajdonságok felvétele <br> (8 magos, 3200mhz, 700w, 8gb ... etc)</p>
                </div>
            </a>
        </div>
    </section>
    <section class="home-section" id="categories">
        <div class="components">
            <div class="component-searcher">
                <h1>Kategóriák</h1></i><br>
                <form action="" method="POST">
                    <div class="search-field">
                        <label for="">Név:</label>
                        <input type="text" class="search-input" name="search">
                        <input type="submit" value="Keresés" class="submit" name="submit-search">
                    </div>
                </form>
            </div>
            <div class="component-result">
                <?php foreach ($categories as $key => $result) : ?>
                    <div class="searcher-result">
                        <?= $result['name']; ?>
                        <a href="tools/categories/delete.php?id='<?= $result['id']; ?>'"><button id="delete" name="delete">Törlés</button></a>
                        <a href="tools/categories/modify.php?id='<?= $result['id']; ?>'"><button id="modify" name="modify">Szerkesztés</button></a>
                        <a href="tools/categories/show.php?id='<?= $result['id']; ?>'"><button id="inspect" name="inspect">Megtekintés</button></a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="footer">
                <a href="tools/categories/new.php"><span>Új kategória rögzítése</span></a>
            </div>
        </div>
    </section>
    <section class="home-section" id="components">
    <div class="components">
            <div class="component-searcher">
                <h1>Alkatrészek</h1></i><br>
                <form action="" method="POST">
                    <div class="search-field">
                        <label for="">Név:</label>
                        <input type="text" class="search-input" name="search">
                        <input type="submit" value="Keresés" class="submit" name="submit-search"><br>
                    </div>
                </form>
            </div>
            <div class="component-result">
                <?php foreach ($components as $key => $result) : ?>
                    <div class="searcher-result">
                        <?= $result['name']; ?>
                        <a href="tools/components/delete.php?id='<?= $result['id']; ?>'"><button id="delete" name="delete">Törlés</button></a>
                        <a href="tools/components/modify.php?id='<?= $result['id']; ?>'"><button id="modify" name="modify">Szerkesztés</button></a>
                        <a href="tools/components/show.php?id='<?= $result['id']; ?>'"><button id="inspect" name="inspect">Megtekintés</button></a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="footer">
                <a href="tools/components/new.php"><span>Új tulajdonság rögzítése</span></a>
            </div>
        </div>
    </section>
    <section class="home-section" id="properties">
    <div class="components">
            <div class="component-searcher">
                <h1>Tulajdonságok</h1></i><br>
                <form action="" method="POST">
                    <div class="search-field">
                        <label for="">Név:</label>
                        <input type="text" class="search-input" name="search">
                        <input type="submit" value="Keresés" class="submit" name="submit-search"><br>
                    </div>
                </form>
            </div>
            <div class="component-result">
                <?php foreach ($properties as $key => $result) : ?>
                    <div class="searcher-result">
                        <?= $result['name']; ?>
                        <a href="tools/properties/delete.php?id='<?= $result['id']; ?>'"><button id="delete" name="delete">Törlés</button></a>
                        <a href="tools/properties/modify.php?id='<?= $result['id']; ?>'"><button id="modify" name="modify">Szerkesztés</button></a>
                        <a href="tools/properties/show.php?id='<?= $result['id']; ?>'"><button id="inspect" name="inspect">Megtekintés</button></a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="footer">
                <a href="tools/properties/new.php"><span>Új tulajdonság rögzítése</span></a>
            </div>
        </div>
    </section>
    <section class="home-section" id="comp_prop">
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