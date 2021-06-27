<?php


function getCurs($url){

    $usd = [
            "code" => "USD",
            "rate" => 1,
    ];

    $curs = json_decode(file_get_contents($url), true);

    $curs['usd'] = $usd;

    return $curs;
}

function getCurList($url){

    $curs = getCurs($url);

    $cur_arr = [];

    foreach($curs as $el){
        $cur_arr[] = $el['code'];
    }

    return $cur_arr;
}

function getRate($cur_name, $curs){

    foreach($curs as $item){
        if($cur_name == $item['code']){

            return $item['rate'];
        }
    }
}

