<?php

require_once("../api/DB.php");

$db = new DB('localhost', 'journalisthelper', 'root', '');


$user = $db->query('SELECT users.user FROM users WHERE id=1', array());

//print_r($user);

echo $user[0]['user'];

?>