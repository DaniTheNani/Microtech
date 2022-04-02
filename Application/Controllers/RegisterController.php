<?php
use App\Models\User;
class RegisterController
{
    public function InsertUser($post)
    {
        global $errors;

        $data['email'] = str_replace("'", "", $post['email']);
        $data['username'] = str_replace("'", "", $post['username']);
        $data['fullname'] = str_replace("'", "", $post['fullname']);
        $data['permission'] = "Felhasználó";
        if (empty($data['email']) || empty($data['username']) || empty($data['fullname'])) {
            return false;
        } else {

            if (empty($errors)) {
                if ($post['passwd'] == $post['passwd2']) {
                } else {
                    $wrongmatchpassword = "Nem egyeznek a jelszavai";
                    echo $wrongmatchpassword;
                    return false;
                }

                $userNamespace = new User;

                if ($userNamespace->getItemBy('username', $data['username'])) {
                    $wrongusername = "A felhasználói név foglalt.";
                    echo $wrongusername;
                    die();
                    return false;
                }

                if ($userNamespace->getItemBy('email', $data['email'])) {
                    $wrongusername = "Az e-mail cím már foglalt";
                    echo $wrongusername;
                    die();
                    return false;
                }

                $user = new User($data);
                if ($user->insert()) {
                }
            }
        }
    }
}
