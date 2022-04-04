<?php
session_start();

include realpath(__DIR__) . "Application/Database.php";

$data = new Database();

$category = $data->read('categories');

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
    <link rel="stylesheet" href="../files/css/main.css?=<?= rand(1, 12000) ?>">
    <title>Micro Tech - Alkatrészek</title>
</head>


<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bi bi-pc-display' style="cursor: pointer;"></i>
            <span class="logo_name" style="cursor:pointer;">Micro Tech</span>
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
                        <a href="#">
                            <i class="bi bi-gpu-card"></i>
                            <span class="link_name">Alkatrészek</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Alkatrészek</a></li>

                        <?php foreach ($Database as $key) : ?>
                            <li id="<?= $key->id ?>"><a href="#Kat<?= $key->id  ?>">
                                    <?= $key->name ?><br>
                                </a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </div>
            <li>
                <section class="profile-details" id="">
                    <div class="profile-content">
                        <img src="/files/images/user.jpg" alt="profileImg">
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
                    <img src="/files/images/user.jpg" alt="" class="user-profilepicture"><br>
                    <figcaption class="img-description">
                        Név: <?php echo $_SESSION['fullname']; ?>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    <?php foreach ($category as $key => $value) : ?>
        <section class="home-section" id="Kat<?= $value->id; ?>">
            <div class="components">
                <div class="component-searcher">
                    <h1>Keresés szűkítése</h1>
                </div>
                <div class="component-result">
                    <?php foreach ($compenent->getItemBy('name', $value->id) as $row) : ?>
                        <div class="component-result-border">
                            <a href="show.php?id=<?= $row->id; ?>">
                                <img class="component-image" src='/files/component-image/<?= $row->image; ?>'>
                                Név: <span class="red"><?= $row->name; ?></span></td>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </section>
    <?php endforeach; ?>

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
        let sidebarBtn = document.querySelector(".bi-pc-display");
        console.log(sidebarBtn);
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