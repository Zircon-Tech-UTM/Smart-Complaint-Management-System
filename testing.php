
<?php
    if(!session_id())//if session_id is not found
        {
            session_start();
        }

    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: login/login.php');
    }


    if(isset($_POST['lang']))
    {
        $_SESSION['language'] =$_POST['lang'];
    }

    echo $_SESSION['language'];

?>

