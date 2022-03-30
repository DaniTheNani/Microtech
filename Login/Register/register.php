<?php
include '../../common/adatkapcsolat.php';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $md5 = md5($password);
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $permission = "Felhasználó";

    $sql = "SELECT password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<scrip>alert('Felhasználónév már foglalt');</script>";
    }else{
        if ($password == $cpassword) {
            $sql2 = $conn->prepare("INSERT INTO users(username, password, email, fullname, permission) VALUES('$username', '$md5', '$email', '$fullname', '$permission')");
            $sql2->execute();
            header("Location: ../login.php");
        }
        else{
            echo "<scrip>alert('Nem egyeznek meg a jelszavak!');</script>";
        }
    }
}
?>