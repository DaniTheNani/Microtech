<?php

$GLOBALS['BASE_DIR'] = realpath(__DIR__);

$GLOBALS['URL'] = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

$GLOBALS['DEV_MODE'] = true;

?>