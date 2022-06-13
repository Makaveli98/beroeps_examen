<?php
require 'dbh.inc.php';

if(isset($_POST['reis_submit'])) 
{
    $bestemmingID = $_POST['bestemming'];
    $reis_periode = mysqli_real_escape_string($conn, $_POST['periode']);
    $reis_type = mysqli_real_escape_string($conn, $_POST['reis_type']);
    $reis_vertrek = mysqli_real_escape_string($conn, $_POST['vertrek']);
    $reis_check_in = mysqli_real_escape_string($conn, $_POST['check_in']);
    $reis_vertrek_date = mysqli_real_escape_string($conn, $_POST['vertrek_date']);
    $reis_reis_nr = mysqli_real_escape_string($conn, $_POST['reis_nummer']);
    $reis_prijs = mysqli_real_escape_string($conn, $_POST['prijs']);

    
    $query_r = mysqli_query($conn, "INSERT INTO reis (bestemmingID, periode, reis_type, departure, check_in, vertrek_date, reis_nr, prijs) 
    VALUES ('$bestemmingID', '$reis_periode', '$reis_type', '$reis_vertrek', '$reis_check_in', '$reis_vertrek_date', '$reis_reis_nr', '$reis_prijs', 
    (SELECT plaats FROM bestemming WHERE idBestemming = $bestemmingID))") or die (mysqli_error($conn));
    if ($query_r) 
    {
        header("Location: ../ADMIN/reizen.admin.php?succes");
        exit(0);   
    } else 
    {
        header("Location: ../ADMIN/reizen.admin.php?no-succes");
        exit(0);
    }
}