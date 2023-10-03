<?php

$database ='estoque';
$db_host = 'localhost';
$db_name ='root';
$db_pass = '';


// $pdo = new PDO("mysql:dbname=".$database.";host=".$db_host,$db_name,$db_pass);

$pdo = new PDO("mysql:host={$db_host};dbname={$database}",$db_name,$db_pass);