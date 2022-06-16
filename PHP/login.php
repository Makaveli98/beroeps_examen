<?php
session_start();

// if(isset($_SESSION['auth']))
// {
//     if($_SESSION['auth_role'] == '1') {
//         header('Location: ../ADMIN/index.admin.php?you-are-already-logged-in');
//     } else {
//         header('Location: index.php?you-are-already-logged-in');
//         exit(0);
//     }
// }
// 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../CSS/login.css">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="form_container">
            <h1>Login</h1>
            <form class="login_form" action="../INCLUDES/login.inc.php" method="POST">
                <div>
                    <label>User ID:</label>
                    <input type="email" name="mail" required placeholder="Enter Email Adress..."> 
                </div>

                <div>
                    <label>Password:</label>
                    <input type="password" name="pwd" required placeholder="Enter Password..."> 
                </div>

                <div>
                    <button type="submit" name="login_btn">Login</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
