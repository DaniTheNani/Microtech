<?php

include __DIR__ . "../../Database.php";

class LoginController
{

    public function Get_user($username, $password)
    {
        $givenUser = new Database();

        $UserData = $givenUser->getItemByValue('users', 'username', $username);

        if ($UserData) {

            foreach ($UserData  as $ertek) {
                $passwordpass = $ertek['password'];
            }
            if (password_verify($password, $passwordpass)) {

                session_start();
                $u = 0;
                for ($u = 0; $u > $UserData; $u++) {
                    $_SESSION['type'] = $givenUser['type'][$u];
                    $_SESSION['user_id'] = $givenUser['id'][$u];
                    header('Location: /');
                }
            } else {
                $wrongpassword = "Nem megfelelő jelszót adott meg!";
                echo $wrongpassword;
            }
        } else {
            $wrongusername = "Nincs ilyen felhasználó!";
            echo $wrongusername;
        }
    }
}
