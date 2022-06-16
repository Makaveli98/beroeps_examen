<?php
require_once 'dbh.inc.php';
session_start();

if(isset($_POST['logout_btn']))
{
    // session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_role']);
    unset($_SESSION['auth_user']);

    header("Location: ../PHP/index.php?you-are-logged-out");
    exit(0);
} 
