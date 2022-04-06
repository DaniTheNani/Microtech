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
                foreach($UserData as $key){
                    $_SESSION['usernameid'] = $key['username'];
                    $_SESSION['fullname'] =  $key['fullname'];
                    $_SESSION['permission'] = $key['permission'];
                }

                Header('Location: ../php/explore.php');
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
