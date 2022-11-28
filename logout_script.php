<?php
session_start();
        unset($_SESSION["auth"]);
    
        if (ini_get("session.use_cookies")) 
        {
            setcookie(session_name(), '', time()-42000);
        }
    
        session_destroy();

        header("Location: login_form.php");
        exit;
?>