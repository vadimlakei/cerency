<?php

require_once '../classes/Action.php';
require_once '../classes/Db.php';
session_start();


if (isset($_SESSION['history'])){
    $rows = $_SESSION['history'];
    $actions = Action::getActions($rows);
} else {
    $actions = Action::getActions();
}

foreach($actions as $item){
    echo('<tr><td>'.$item['date'].'</td><td>'.$item['amount'].'</td><td>'.$item['cur_from'].'</td><td>'.$item['cur_to'].'</td><td>'.$item['result'].'</td></tr>');
}
