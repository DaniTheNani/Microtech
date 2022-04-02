<?php

namespace App;

class Helper{
    public static function passwdcrypt(string $passwd){
        $options = ['cost'=>12];
        return password_hash($passwd, PASSWORD_BCRYPT, $options);
    }
}

?>