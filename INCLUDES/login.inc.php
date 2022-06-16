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
        header("Location: ../PHP/login.php?invalid-mail-or-pwd");
        exit(0);
    }

}
?>


<!-- 
// if (isset($_POST['login-submit'])) {
//     require 'dbh.inc.php';

//     $mailuid = $_POST['mailuid'];
//     $password = $_POST['pwd'];

//     if (empty($mailuid) || empty($password)) {
//         header("Location: ../PHP/index.php?error=emptyfields");
//         exit();

//     } else {
//         $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?; ";
//         $stmt = mysqli_stmt_init($conn);

//         if (!mysqli_stmt_prepare($stmt, $sql)) {
//             header("Location: ../PHP/index.php?sqlerror");
//             exit();
            
//         } else {
//             mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
//             mysqli_stmt_execute($stmt);
//             $result = mysqli_stmt_get_result($stmt);

//             if ($row = mysqli_fetch_assoc($result)) {
//                 $pwdCheck = password_verify($password, $row['pwdUsers']);
//                 if ($pwdCheck == false) {
//                     header("Location: ../PHP/index.php?wrongpwd");
//                     exit();

//                 } else if ($pwdCheck == true) {
//                     session_start();
//                     $_SESSION['userId'] = $row['idUsers'];
//                     $_SESSION['userUid'] = $row['uidUsers'];

//                     header("Location: ../PHP/index.php?login=succes");
//                     exit();

//                 } else {
//                     header("Location: ../PHP/index.php?wrongpwd");
//                     exit();
//                 }
                
//             } else { 
//                 header("Location: ../PHP/index.php?nouser");
//                 exit();
//             }
//         }
//     }
// }

// else {
//     header("Location: ../PHP/index.php");
//     exit();

// } -->