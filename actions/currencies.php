<?php

require_once('functions.php');
session_start();

if(isset($_SESSION['currencies_selected'])){

    echo json_encode($_SESSION['currencies_selected']);

} else {

    $params = include "../config/config.php";
    $cur = getCurList($params['api_url']);

    echo json_encode($cur);
}




