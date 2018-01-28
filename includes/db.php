<?php
$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'cms';

//convert the array above into constants

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}
// echo $key;

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// if($connection){
//     echo "We are connected";
// }

//easy way
// $connection = mysqli_connect('localhost', 'root', '', 'cms');
// if($connection){
//     echo "We are connected";
// }


?>