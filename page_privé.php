<?php
session_start();

if ( ! isset($_SESSION["auth"]) ) 
{
//     header("Location:login_form.php");
//     exit;
echo"Cette page nécessite une identification.";  
exit;
}
echo "Bonjour ".$_SESSION["auth"]."<br>"."- session ID : ".session_id();

     
?>