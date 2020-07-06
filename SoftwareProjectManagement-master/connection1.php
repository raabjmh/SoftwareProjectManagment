<?php

 $DB_SERVER= 'localhost';
 $DB_USERNAME = 'root';
 $DB_PASSWORD='';
 $DB_DATABASE='MP';
 $db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
 $db->query("SET NAMES utf8");
 $db->query("SET CHARACTER SET utf8");
 // check the connection
 if(!$db)
{
    die("connection faill".mysqli_connect_error());
}


?>
