<?php

session_start();
if(!empty($_SESSION["name"])) {

    require_once './dashboard.php';
} else {

    require_once './login.php';
}
?>