<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- regular css -->
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/table.css">
    <!-- admin CSS -->
    <link rel="stylesheet" href="../ADMIN CSS/navbar.admin.css">
    <link rel="stylesheet" href="../ADMIN CSS/style.admin.css">
  

    <title>Document</title>
</head>
<body>

<header class="header" id="header">
    <div class="header_wrapper" id="header_wrapper">


        <figure class="figure" id="figure">
            <div class="logo"></div>
        </figure>

        <?php if(isset($_SESSION['auth'])) 
        {
          
            if($_SESSION['auth_role'] == '1')
            {
                ?>
                <h3 class="role">Admin</h3>
                <div class="account_box">
                    <div class="name_box"><h4><?=$_SESSION['auth_user']['user_name'];?></h4></div>
                    <a href="../ADMIN/index.admin.php"><button>Admin Dashboard</button></a>
                    <form action="../INCLUDES/logout.inc.php" method="POST">
                        <a href=""><button type="submit" class="logout_btn" id="logout_btn" name="logout_btn">Log Out</button></a>
                    </form>
                </div>       
                <?php
            }elseif($_SESSION['auth_role'] == '0' || $_SESSION['auth_role'] == NULL) 
            {
                ?>
                <h3 class="role">User</h3>
                <div id="role">
                    <?=$_SESSION['auth_user']['user_name'];?>
                    <form action="../INCLUDES/logout.inc.php" method="POST">
                        <button type="submit" class="logout_btn" id="btn" name="logout_btn">Log Out</button>
                    </form>   
                </div>     
                <?php
            }
           
        } else 
        {
            ?>
                <h3 id="guest_id">Guest</h3>
                <div id="role">
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
            <?php
        }
        ?>
    </div>
</header>

