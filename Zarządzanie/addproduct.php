<?php

require_once 'connect.php';

$path = "unpload/" . time() . "_" . $_FILES['image']['name'];

if(isset($_POST)){
    //add product

    $nazwa = $_POST['title'];
    $opis = $_POST['description'];
    $ilosc = $_POST['ilosc'];
    $cena = $_POST['cena'];

    $query = mysqli_query($connect, 
    "INSERT INTO `towary` (`ID`, `tytul`, `img`, `opis`, `ilosc`, `cena`, `kierunek`) 
    VALUES (NULL, '$nazwa', '$path', '$opis', '$ilosc', '$cena', NULL)");

    if($query){
        header('Location: decision.php');
    }
    
}else header('Location: decision.php');
