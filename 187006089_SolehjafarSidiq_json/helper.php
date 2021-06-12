<?php

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('DB', 'soleh_zadu');

    $db_connect = mysqli_connect ( HOST,USER,PASS,DB)  or die ('unable connect');

    header('Content-Type: application/json');
?>