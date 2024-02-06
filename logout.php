<?php
session_start();
session_destroy();
if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);

}
echo ("<script LANGUAGE='JavaScript'>
    window.alert('Logged Out');
    window.location.href='index.php';
    </script>");

die;?> 