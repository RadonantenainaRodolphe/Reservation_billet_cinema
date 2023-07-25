<?php 
session_start();
//destruction du session
session_unset();
//redirection vers login fomulaire
header("Location:../index.php");