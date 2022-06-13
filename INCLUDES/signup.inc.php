<?php

require ('dbh.inc.php');

if(isset($_POST['signup_btn'])) 
{

    $fname = mysqli_real_escape_string($conn, $_POST['voornaam']);
    $tvg = mysqli_real_escape_string($conn, $_POST['tvg']);
    $lname = mysqli_real_escape_string($conn, $_POST['achternaam']);
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $tel_nr = mysqli_real_escape_string($conn, $_POST['tel_nr']);
    $DoB = mysqli_real_escape_string($conn, $_POST['DoB']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $r_pwd = mysqli_real_escape_string($conn, $_POST['conf_pwd']);

    if($pwd == $r_pwd)
    {
        $ch_mail = "SELECT email FROM users WHERE email='$mail'";
        $ch_mail_run = mysqli_query($conn, $ch_mail);

        if(mysqli_num_rows($ch_mail_run) > 0) 
        {
            header('Location: ../PHP/signup.php?EmailAlreadyExists');
            exit();
        }
        else 
        {
            $u_query = "INSERT INTO users (voornaam, tvg, achternaam, email, telefoon_nr, DoB, pwd, pwd_rep) VALUES ('$fname', '$tvg', '$lname', '$mail', '$tel_nr', '$DoB', '$pwd', '$r_pwd')";
            $u_query_run = mysqli_query($conn, $u_query);

            if($u_query_run) 
            {
                header('Location: ../PHP/login.php?Register=succes');
                exit();
            }
            else 
            {
                header('Location: ../PHP/signup.php?SomethingWentWrong');
                exit();
            }
        }
    }
    else 
    {
        header('Location: ../PHP/signup.php?Password and Confrimed Password do not Match');
        exit();
    }
   
}
