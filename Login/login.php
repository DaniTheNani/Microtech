<?php
include '../common/adatkapcsolat.php';

session_start();

// if (isset($_POST['username']) && isset($_POST['password'])) {
 if (isset($_POST['submit-login'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];
     $md5 = md5($password);

     $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$md5'";
     $result = mysqli_query($conn, $sql);
     if ($result->num_rows > 0) {
         $sql2 = "SELECT * FROM  users WHERE username = '$username'";
         $result2 = mysqli_query($conn, $sql2);
         while ($row = mysqli_fetch_array($result2)) {
             $permission = $row["permission"];
             $fullname = $row["fullname"];
             $email = $row["email"];
         }
         $_SESSION['username'] = $username;
         $_SESSION['permission'] = $permission;
         $_SESSION['fullname'] = $fullname;
         $_SESSION['email'] = $email;
         header("Location: ../php/explore.php");
     } else {
         echo "<script>alert('Hibás felhasználónév vagy jelszó!');</script>";
     }
 }
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroTech - login</title>
</head>

<body>
    <div class="background">
        <video src="../images/Lake - 91562.mp4" muted loop autoplay></video>
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
                <img src="../images/fb.png">
                <img src="../images/tw.png">
                <img src="../images/gp.png">
            </div>
            <form action="" method="post" id="login" class="input-group">
                <input type="text" class="input-field" name="username" id="white" placeholder="Felhasználónév" required>
                <input type="password" class="input-field" name="password" id="white" placeholder="Jelszó" required>
                <input type="checkbox" name="checkbox" class="check-box"><span>Maradjon bejelentkezve </span>
                <input type="submit" name="submit-login" id="white" value="Bejelentkezés" class="submit-btn">
            </form>
            <form action="Register/register.php" method="post" id="register" class="input-group">
                <input type="text" class="input-field" name="username" id="white" placeholder="Felhasználónév" required>
                <input type="text" class="input-field" name="fullname" id="white" placeholder="Teljes név" required>
                <input type="email" class="input-field" name="email" id="white" placeholder="Email-cím" required>
                <input type="password" class="input-field" name="password" id="white" placeholder="Jelszó" required>
                <input type="password" class="input-field" name="cpassword" id="white" placeholder="Jelszó mégegyszer" required>
                <input type="checkbox" class="check-box" required><span>Elfogadom a felhasználási feltételeket</span>
                <button type="submit" name="submit" id="white" class="submit-btn">Regisztrálás</button>
            </form>
        </div>
    </div>
</body>

</html>