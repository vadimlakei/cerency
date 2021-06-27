<?php


require_once 'functions.php';
require_once '../classes/Action.php';
require_once '../classes/Db.php';

$params = include "../config/config.php";

if(isset($_POST) && count($_POST)>0 ) {

    if (!empty($_POST['amount']) && !empty($_POST['from']) && !empty($_POST['to'])) {

        $amount = $_POST['amount'];
        $from = $_POST['from'];
        $to = $_POST['to'];
        $cur_arr = getCurList($params['api_url']);

        if (in_array($from, $cur_arr) && in_array($to, $cur_arr)) {

            $curs = getCurs($params['api_url']);
            $rateFrom = getRate($from, $curs);
            $rateTo = getRate($to, $curs);
            $result = round(($amount / $rateFrom) * $rateTo, 2);

            if($result){

                Action::addAction($amount, $from, $to, $result);
            }

            echo($result);
        }
    }
}