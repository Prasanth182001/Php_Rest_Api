<?php

$db_connect =mysqli_connect("localhost","root","","api");

if(!$db_connect)
{
    die("MySql Connection Failed :".mysqli_connect_error()) ;
}


?>