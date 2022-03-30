<?php

session_start();

include "../common/adatkapcsolat.php";
include "../View/head.php";

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
$newcatsuccess = "";
$newcatnotsuccess = "";
$deletecatsuccess = "";
$deletecatnotsuccess = "";
if (isset($_POST['cat-submit'])) {
    $catname = $_POST['catname'];
    $sql2 = "SELECT * FROM categories WHERE name = '$catname'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        $newcatnotsuccess = "Már van egy ilyen kategória!";
    } else {
        $sql3 = $conn->prepare("INSERT INTO categories(name) VALUES('$catname')");
        $sql3->execute();
        $newcatsuccess = "Sikeresen rögzítettük!";
    }
}

$sql4 = "SELECT * FROM components";
$result4 = $conn->query($sql4);
$newcompsuccess = "";
$newcompnotsuccess = "";
$deletecompsuccess = "";
$deletecompnotsuccess = "";

if (isset($_POST['comp-submit'])) {
    $compname = $_POST['compname'];
    $sql5 = "SELECT * FROM components WHERE name = '$compname'";
    $result5 = $conn->query($sql5);
    if ($result5->num_rows > 0) {
        $newcompnotsuccess = "Már van egy ilyen alkatrész!";
    } else {
        $sql6 = $conn->prepare("INSERT INTO components(name) VALUES('$compname')");
        $sql6->execute();
        $newcompsuccess = "Sikeresen rögzítettük!";
    }
}

$sql7 = "SELECT * FROM properties";
$result7 = $conn->query($sql7);
$newpropsuccess = "";
$newpropnotsuccess = "";
$deletepropsuccess = "";
$deletepropnotsuccess = "";

if (isset($_POST['prop-submit'])) {
    $propname = $_POST['propname'];
    $sql8 = "SELECT * FROM properties WHERE name = '$propname'";
    $result8 = $conn->query($sql8);
    if ($result8->num_rows > 0) {
        $newpropnotsuccess = "Már van egy ilyen tulajdonság!";
    } else {
        $sql9 = $conn->prepare("INSERT INTO properties(name) VALUES('$propname')");
        $sql9->execute();
        $newpropsuccess = "Sikeresen rögzítettük!";
    }
}

if (isset($_POST['cat-submit-delete'])) {
    $id = $_POST['catid'];
    $sql10 = "DELETE FROM categories WHERE id = '$id'";
    $result10 = $conn->prepare($sql10);
    $result10->execute();
    $deletecatsuccess = "Sikeresen töröltük az adatbázisból!";
}
if (isset($_POST['comp-submit-delete'])) {
    $id = $_POST['compid'];
    $sql11 = "DELETE FROM components WHERE id = '$id'";
    $result11 = $conn->prepare($sql11);
    $result11->execute();
    $deletecompsuccess = "Sikeresen töröltük az adatbázisból!";
}
if (isset($_POST['prop-submit-delete'])) {
    $id = $_POST['propid'];
    $sql12 = "DELETE FROM properties WHERE id = '$id'";
    $result12 = $conn->prepare($sql12);
    $result12->execute();
    $deletepropsuccess = "Sikeresen töröltük az adatbázisból!";
}

?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="explore.php">
                    <i class='bx bx-compass'></i>
                    <span class="link_name">Felfedezés</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="explore.php">Felfedezés</a></li>
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
                        <img src="../images/user.jpg" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name"><?php echo $_SESSION['fullname']; ?></div>
                        <div class="job"><?php echo $_SESSION['permission']; ?></div>
                    </div>
                    <a href="logout.php"><i class='bx bx-log-out'></i></a>
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
                    <img src="../images/user.jpg" alt="" class="user-profilepicture"><br>
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
            <a href="#new-comp-prop">
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
                        foreach ($result as $key) :   ?>
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
                <div class="form">
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                        <input type="text" id="compname" class="form_input" name="compname" autocomplete="off" placeholder=" " require>
                        <label for="compname" class="form_label">Alkatrész</label>
                        <input type="submit" name="comp-submit" value="Rögzítés" class="submit-btn">
                    </form>
                </div>
                <div class="result">
                    <span class="success"><?php echo $newcompsuccess ?></span>
                    <span class="notsuccess"><?php echo $newcompnotsuccess ?></span>
                </div>
            </div>
            <div class="list-box">
                <h5>Jelenlegi alkatrészek az adatbázisban</h5>
                <ul>
                    <li>
                        <?php
                        foreach ($result4 as $key) :   ?>
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
                        foreach ($result7 as $key) :   ?>
                            <?= $key['id'] ?> . <?= $key['name'] ?><br>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
    </section>
    <section class="home-section" id="new-comp-prop">
        <div class="container">
            <div class="category-box" style="width: 100%;">
                <h1>Meglévő alkatrész tulajdonságának megadása</h1>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                <br>
                    <div class="form">
                        <input type="text" id="comp_prop" class="form_input" name="comp_prop" autocomplete="off" placeholder=" " require>
                        <label for="comp_prop" class="form_label">Magok száma:</label>
                    </div><br>
                    <div class="form">
                        <input type="text" id="comp_prop" class="form_input" name="comp_prop" autocomplete="off" placeholder=" " require>
                        <label for="comp_prop" class="form_label">Tulajdonság</label>
                    </div><br>
                    <div class="form">
                        <input type="text" id="propname" class="form_input" name="propname" autocomplete="off" placeholder=" " require>
                        <label for="propname" class="form_label">Tulajdonság</label>
                    </div><br>
                    <div class="form">
                        <input type="text" id="propname" class="form_input" name="propname" autocomplete="off" placeholder=" " require>
                        <label for="propname" class="form_label">Tulajdonság</label>
                    </div><br>
                    <div class="form">
                        <input type="text" id="propname" class="form_input" name="propname" autocomplete="off" placeholder=" " require>
                        <label for="propname" class="form_label">Tulajdonság</label>
                        <input type="submit" name="prop-submit" value="Rögzítés" class="submit-btn">
                    </div>
                </form>
                <div class="result">
                    <span class="success"><?php echo $newpropsuccess ?></span>
                    <span class="notsuccess"><?php echo $newpropnotsuccess ?></span>
                </div>
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
                        foreach ($result as $key) :   ?>
                            <?= $key['id'] ?> . <?= $key['name'] ?><br>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="home-section" id="delete-components">
        <div class="container">
            <div class="category-box">
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
                        foreach ($result4 as $key) :   ?>
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
                        foreach ($result7 as $key) :   ?>
                            <?= $key['id'] ?> . <?= $key['name'] ?><br>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>
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