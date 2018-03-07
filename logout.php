<?php
session_start();
unset($_SESSION['belep']);
unset($_SESSION['nick_name']);
header("location: index.php");
?>