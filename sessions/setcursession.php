<?php

session_start();

if(isset($_POST)) {

    $_SESSION["currencies_selected"] = $_POST["checks"];
}