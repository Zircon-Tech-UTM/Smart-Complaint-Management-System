<?php
session_start();

//Destroy session and redirect to login page
if(session_destroy())
{
	header("location: login.php");
}

?>