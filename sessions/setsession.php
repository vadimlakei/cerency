<?php

session_start();

if(isset($_POST)) {

    $_SESSION["history"] = $_POST["history"];

}


