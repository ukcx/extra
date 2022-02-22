<?php

$db = mysqli_connect('localhost', 'root', '', 'airtravel');

if($db->maxdb_connect_errno = 0){
	die('Unable to connect to database [' . $db->maxdb_connect_error . ']');
}

?>