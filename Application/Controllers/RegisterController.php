<?php

include __DIR__ ."../../Helper.php";

class RegisterController
{
    public function InsertUser($post)
    {
        $data['username'] = $post['username'];
        $data['fullname'] = $post['fullname'];
        $data['email'] = $post['email'];
        $data['permission'] = "Felhasználó";

        $insertUser = new Database();

        $ExistUsername = $insertUser->getItemByValue('users', 'username', $data['username']);

        var_dump($ExistUsername);

        if (empty($data['email']) || empty($data['username']) || empty($data['fullname'])) {
            return false;
        } else {

            if (empty($errors)) {
                if ($post['password'] == $post['cpassword']) {
                    $data['password'] = Helper::Crypt($post['password']);
                } else {
                    $wrongmatchpassword = "Nem egyeznek a jelszavai";
                    echo $wrongmatchpassword;
                    return false;
                }

                if ($post['username'] == $ExistUsername) {
                    $wrongusername = "A felhasználói név foglalt.";
                    echo $wrongusername;
                    return false;
                }
            }
            $insertUser->insert('users', $data);
        }
    }
}
