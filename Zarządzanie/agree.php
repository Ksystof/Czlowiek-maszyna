<?php
require_once 'connect.php';

$id = $_GET['id']; // Get the item ID from the URL parameter

// Retrieve item details from the database
$process = mysqli_query($connect, "SELECT * FROM `towary` WHERE `ID` = '$id';");

if ($process) {
    $row = mysqli_fetch_assoc($process);
    $title = $row['tytul'];
    $img = $row['img']; // Access the 'img' column from the retrieved row
    $opis = $row['opis']; // Access the 'opis' column from the retrieved row
    $ilosc = $row['ilosc']; // Access the 'ilosc' column from the retrieved row
    $cena = $row['cena']; // Access the 'ilosc' column from the retrieved row

    // Continue processing the $title or other data as needed

    $a = 'Akceptacja';

    // Insert the item into another table or perform other operations
    $query = mysqli_query($connect, "INSERT INTO `towar_zatw` (`ID`, `tytul`, `img`, `opis`, `ilosc`, `cena`, `kierunek`) 
    VALUES (NULL, '$title', '$img', '$opis', '$ilosc', '$cena', '$a');");

    if ($query) {
        // Delete the item from the 'towary' table based on the provided ID
        $deleteQuery = mysqli_query($connect, "DELETE FROM `towary` WHERE `ID` = '$id'");

        if ($deleteQuery) {
            // Redirect to the 'decision.php' page
            header('Location: decision.php');
            exit();
        } else {
            echo "An error occurred while deleting the record.";
            header('Location: decision.php');
        }
    } else {
        echo "An error occurred while adding the record.";
        header('Location: decision.php');
    }
} else {
    // Handle the case when the query fails
    echo "Failed to retrieve item details.";

    header('Location: decision.php');
}
?>
