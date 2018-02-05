<?php
$db_host = 'localhost';
$db_user = 'alexander';
$db_pass = 'mypass';
$db_name = 'xxx';

$link =  new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
