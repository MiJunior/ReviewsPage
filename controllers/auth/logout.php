<?php
session_start();
unset($_SESSION['session_username']);
unset($_SESSION['role_id']);
session_destroy();
header("location:../login.php");