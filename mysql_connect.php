<?php
$dbc=mysqli_connect('localhost','root','','appdev');

if (!$dbc) {
 die('Could not connect: '.mysql_error());
}

?>
