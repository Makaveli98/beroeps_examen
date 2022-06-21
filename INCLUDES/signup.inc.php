<?php
require_once ('dbh.inc.php');

// check of de knop ingedrukt wordt
if(isset($_POST['signup_btn'])) 
{
    // initialiseren van variabelen en die een value geven
    $fname = mysqli_real_escape_string($conn, $_POST['voornaam']);
    $tvg = mysqli_real_escape_string($conn, $_POST['tvg']);
    $lname = mysqli_real_escape_string($conn, $_POST['achternaam']);
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $tel_nr = mysqli_real_escape_string($conn, $_POST['tel_nr']);
    $DoB = mysqli_real_escape_string($conn, $_POST['DoB']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $r_pwd = mysqli_real_escape_string($conn, $_POST['conf_pwd']);

    // kijken of de wachtwoord en het repeat wachtoord overeen komen
    if($pwd == $r_pwd)
    {
        // dan selecteer je de kolom email van de users table en kijk je of in de kolom email 
        // de ingevulde email overeen komt met wat in de kolom staat
        $ch_mail = "SELECT email FROM users WHERE email='$mail'";
        $ch_mail_run = mysqli_query($conn, $ch_mail);

        // dan kijk je of de ingevulde mail al in de kolom zit 
        if(mysqli_num_rows($ch_mail_run) > 0) 
        {
            header('Location: ../PHP/signup.php?EmailAlreadyExists');
            exit();
        }
        else 
        {
            // kijken of de input field empty is
            if(empty($fname) || empty($lname) || empty($mail) || empty($tel_nr) || empty($DoB) ) {
                header('Location: ../PHP/signup.php');
                echo "Alle gegevens invoeren!";
                exit(0);
            } 
            else 
            {
                // als de input field niet empty is dan voer je de ingevulde gegevens in de database
                $u_query = "INSERT INTO users (voornaam, tvg, achternaam, email, telefoon_nr, DoB, pwd, pwd_rep) 
                VALUES ('$fname', '$tvg', '$lname', '$mail', '$tel_nr', '$DoB', '$pwd', '$r_pwd')";
                $u_query_run = mysqli_query($conn, $u_query);
    
                if($u_query_run) 
                {
                    header('Location: ../PHP/index.php?Register=succes');
                    exit();
                }
                else 
                {
                    header('Location: ../PHP/signup.php?SomethingWentWrong');
                    exit();
                }

            }
           
        }
    }
    else 
    {
        header('Location: ../PHP/signup.php?Password and Confrimed Password do not Match');
        exit();
    }
   
}
