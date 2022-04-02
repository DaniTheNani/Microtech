<?php

namespace App\Controllers;

use App\Models\User;

class LoginController
{

    public function Get_user($username, $password)
    {
        global $session;

        $users = new User;

        $givenUser = $users->getItemBy('username', $username);


        if ($givenUser) {

            $passwordpass = $givenUser->password;

            if (password_verify($password, $passwordpass)) {


                if ($session->create($givenUser->id)) {
                    header('Location: ../index.php');
                };
            } else {
                $wrongpassword = "Nem megfelelő jelszót adott meg!";
                echo $wrongpassword;
            }
        } else {
            $wrongusername = "Nincs ilyen felhasználónév!";
            echo $wrongusername;
        }
    }
}
