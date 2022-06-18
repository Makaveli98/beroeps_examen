<?php
require_once('dbh.inc.php');
ob_start(); 
session_start();

if(isset($_POST['login_btn'])) {

    $email = mysqli_real_escape_string($conn, $_POST['mail']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    $login_query = "SELECT * FROM users WHERE email='$email' AND pwd='$pwd'";
    $login_query_run = mysqli_query($conn, $login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    {
        foreach($login_query_run as $data)
        {
            $user_id = $data['idUser'];
            $user_name = $data['voornaam']. "" .$data['tvg']. "" .$data['achternaam'];
            $user_email = $data['email'];
            $user_tnr = $data['telefoon_nr'];
            $role = $data['role'];
        }

        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$role";
        $_SESSION['auth_user'] = [
            'user_id'=>$user_id,
            'user_name'=>$user_name,
            'user_email'=>$user_email,
            'user_tnr'=>$user_tnr
        ];
        
        if($_SESSION['auth_role'] == '1')
        {
            header("Location: ../PHP/index.php?user-page");
            exit(0);
        }
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