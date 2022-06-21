<?php
require_once('dbh.inc.php');
ob_start(); 
session_start();

// kijken of knop ingedrukt wordt
if(isset($_POST['login_btn'])) {

    // het initialiseren van variabelen en die een value geven
    $email = mysqli_real_escape_string($conn, $_POST['mail']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    $login_query = "SELECT * FROM users WHERE email='$email' AND pwd='$pwd'";
    $login_query_run = mysqli_query($conn, $login_query);

    // kijken of er gegevens in de table zitten
    if(mysqli_num_rows($login_query_run) > 0)
    {   
        // dan zet je de data van de table in een apart variable
        foreach($login_query_run as $data)
        {
            // dan roep je het op vanuit de database
            $user_id = $data['idUser'];
            $user_name = $data['voornaam']. "" .$data['tvg']. "" .$data['achternaam'];
            $user_email = $data['email'];
            $user_tnr = $data['telefoon_nr'];
            $role = $data['role'];
        }

        // hier initialiseer je session variabelen en geef je die een value vanuit de database
        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$role";
        $_SESSION['auth_user'] = [
            'user_id'=>$user_id,
            'user_name'=>$user_name,
            'user_email'=>$user_email,
            'user_tnr'=>$user_tnr
        ];
        
        // kijk je of de login user een admin is
        if($_SESSION['auth_role'] == '1')
        {
            header("Location: ../PHP/index.php?user-page");
            exit(0);
        }
        // dit is voor de users
        elseif($_SESSION['auth_role'] == '0' || $_SESSION['auth_role'] == NULL) 
        {
            header("Location: ../PHP/index.php?user-page");
            exit(0);
        }
    }
    else 
    {
        header("Location: ../PHP/index.php?invalid-mail-or-pwd");
        exit(0);
    }

}
?>