<?php
	//
$mysqli = new mysqli("localhost", "root", "ddeenn16102001", "it_yura");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else{
//echo "OK";
}

$mysqli->query("set names utf8");
//echo "connected";
    ?>