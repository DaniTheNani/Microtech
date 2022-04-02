<?php

include (__DIR__ . "../../Database.php");

class LoginController
{

    public function Get_user($username, $password)
    {

        $givenUser = new Database();

        $givenUser = $givenUser->getItemByValue('users', 'username', $username);

        if ($givenUser) {

            foreach ($givenUser as $value) {
                $passwordpass = $value['password'];
                
            }
            var_dump($givenUser);

            if (password_verify($password, $passwordpass)) {

                session_start();
                foreach ($givenUser as $value) {
                    $_SESSION['type'] = $value['type'];
                    
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
