<?php
class Autoloader
{
    public function __construct()
    {
        session_start();
        spl_autoload_register(array($this, 'autoload'));
    }
    public function autoload($class)
    {
        $file = dirname(__DIR__) . '\\' . $class . '.php';
        var_dump($file);
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
        if (file_exists($file)) {
            include $file;
        }
    }
}
$autoloader = new Autoloader();
