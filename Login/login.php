<?php

include (__DIR__ . "../../Application/Controllers/LoginController.php");
include (__DIR__ . "../../Application/Controllers/RegisterController.php");


if (isset($_POST['submit-register'])) 
{
    $registernamespace = new RegisterController();
    $registernamespace->InsertUser($_POST);
}

if(isset($_POST['submit-login']))
{
    $loginnamespace = new LoginController();
    $loginnamespace->Get_user($_POST['username'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../files/css/login.css?=<?= rand(1, 12000) ?>">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="../files/js/login.js"></script>
    <title>MicroTech - login</title>
</head>

<body>
    <div class="background">
        <video src="../files/images/Lake - 91562.mp4" muted loop autoplay></video>
        <div class="header">
            <a href="../index.php"><button type="button" class="header-btn"><span></span>Vissza a főoldalra!</button></a>
        </div>
        <div class="form-box">
            <div class="cim">
                <i class='bx bx-code-alt'></i>
                <label class="MicroTech">Micro Tech</label>
            </div>
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" onclick="login()" id="white" class="toggle-btn">Bejelentkezés</button>
                <button type="button" onclick="register()" id="white" class="toggle-btn">Regisztráció</button>
            </div>
            <div class="social-icons">
                <img src="../Files/images/fb.png">
                <img src="../Files/images/tw.png">
                <img src="../Files/images/gp.png">
            </div>
            <form action="" method="post" id="login" class="input-group">
                <input type="text" class="input-field" name="username" id="white" placeholder="Felhasználónév" required>
                <input type="password" class="input-field" name="password" id="white" placeholder="Jelszó" required>
                <input type="checkbox" name="checkbox" class="check-box"><span>Maradjon bejelentkezve </span>
                <input type="submit" name="submit-login" id="white" value="Bejelentkezés" class="submit-btn">
            </form>
            <form action="" method="post" id="register" class="input-group">
                <input type="text" class="input-field" name="username" id="white" placeholder="Felhasználónév" required>
                <input type="text" class="input-field" name="fullname" id="white" placeholder="Teljes név" required>
                <input type="email" class="input-field" name="email" id="white" placeholder="Email-cím" required>
                <input type="password" class="input-field" name="passwd" id="white" placeholder="Jelszó" required>
                <input type="password" class="input-field" name="passwd2" id="white" placeholder="Jelszó mégegyszer" required>
                <input type="checkbox" class="check-box" required><span>Elfogadom a felhasználási feltételeket</span>
                <button type="submit" name="submit-register" id="white" class="submit-btn">Regisztrálás</button>
            </form>
        </div>
    </div>
</body>

</html>