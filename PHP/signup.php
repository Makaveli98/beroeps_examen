<?php 
session_start();

if(isset($_SESSION['auth']))
{
    header('Location: ../index.php?you-are-already-logged-in');
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/signup.css">

    <title>Signup</title>
</head>
<body>
<main>
    <div class="form_container">
        <h1>Signup</h1>
        <form class="signup_form" action="../INCLUDES/signup.inc.php" method="POST">
            <div class="separator">
                <div>
                    <label for="fname">Naam:</label>
                    <input required type="text" name="voornaam" id="fname" placeholder="Voornaam..."><br>
                </div>

                <div>
                    <label for="tvg">tvg:</label>
                    <input type="text" name="tvg" id="tvg" placeholder="tvg.."><br>
                </div>
                
                <div>
                    <label for="lname">Achternaam:</label>
                    <input required type="text" name="achternaam" id="lname" placeholder="Achternaam..."><br>
                </div>

                <div>
                    <label for="mail">Email...</label>
                    <input required type="email" name="mail" id="mail" placeholder="E-mail..."><br><br>
                </div>
            </div>

            <div class="separator">
                <div>
                    <label for="tel_nr">Telefoonnummer...</label>
                    <input required type="tel" name="tel_nr" id="tel_nr" placeholder="Telefoonnummer..."><br>
                </div>

                <div>
                    <label for="DoB">Geboorte_datum...</label>
                    <input required type="date" name="DoB" id="DoB"><br>
                </div>

                <div>
                    <label for="pwd">Wachtwoord:</label>
                    <input required type="password" name="pwd" id="pwd" placeholder="Wachtwoord..."><br>
                </div>

                <div>
                    <label for="conf_pwd">Bevestig Wachtwoord</label>
                    <input required type="password" name="conf_pwd" id="conf_pwd" placeholder="Bevestig Wachtwoord..."><br>
                    
                    <button type="submit" name="signup_btn">Signup</button> 
                </div>
            </div>
        </form>
    </div>

</main>

    
</body>
</html>