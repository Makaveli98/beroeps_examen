<?php
require_once 'dbh.inc.php';
session_start();

if(isset($_POST['boeking_btn'])) 
{
    if(isset($_SESSION['auth'])) 
    {
        $user_id = $_SESSION['auth_user']['user_id'];
        $reisID = mysqli_real_escape_string($conn, $_POST['pk_reis']);
        $bstmID = mysqli_real_escape_string($conn, $_POST['pk_bstm']);

        $res_query = mysqli_query($conn, "INSERT INTO boeking (reisID, userID, bstmID) 
        VALUES ('$reisID', '$user_id', '$bstmID')") or die (mysqli_error($conn));
    
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
    }
    else 
    {
        header('Location: ../LINKPAGES/reizen.php?NOT AUTH');
        exit(0);
    }
}