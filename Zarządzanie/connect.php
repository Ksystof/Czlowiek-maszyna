<?php

$connect = mysqli_connect('localhost', //host
'root', //user
'', // password
'human-pc'); //database

if(!$connect) {
    die('Error connect to DataBase');
}