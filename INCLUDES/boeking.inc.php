<?php
// session_start();
require 'dbh.inc.php';
if(isset($_POST['boeking_btn'])) 
{
    // if($_SESSION['auth']) 
    // {
        $reisID = $_POST['pk_reis'];
        $r_nummer = $_POST['nr'];
    
        $res_query = mysqli_query($conn, "INSERT INTO boeking (reisID, r_nummer,  naam_bstm) 
        VALUES ('$reisID', '$r_nummer', 
        (SELECT bestemming FROM reis WHERE idReis = $reisID))") or die (mysqli_error($conn));
    
        if($res_query) 
        {
            header('Location: ../LINKPAGES/reizen.php?SUCCES');
            exit(0);
        }
        else 
        {
            header('Location: ../LINKPAGES/boeking.php?FAIL');
            exit(0);
        }
        exit(0);
    // }
    // else 
    // {
    //     header('Location: ../LINKPAGES/reizen.php?NOT AUTH');
    //     exit(0);
    // }
}