<?php

require_once("../api/DB.php");

$db = new DB('localhost', 'journalisthelper', 'root', '');

while (true) {

$date = date('Y/m/d H:i:s');
$db->query('INSERT INTO carbons VALUES (NULL, :data, :phpdate)', array(':data'=>rand(10,50), ':phpdate'=>$date));
$db->query('INSERT INTO globaltemperature VALUES (NULL, :data, :phpdate)', array(':data'=>rand(10,50), ':phpdate'=>$date));
$db->query('INSERT INTO seaice VALUES (NULL, :data, :phpdate)', array(':data'=>rand(10,50), ':phpdate'=>$date));
$db->query('INSERT INTO sealevel VALUES (NULL, :data, :phpdate)', array(':data'=>rand(10,50), ':phpdate'=>$date));
sleep(1);

}

?>
