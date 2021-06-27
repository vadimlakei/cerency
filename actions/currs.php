<?php

require_once('functions.php');

$params = include "../config/config.php";

$cur = getCurList($params['api_url']);

foreach($cur as $el){
//    echo('<li>' . $el . '</li>');
    echo('  <div class="form-check form-check-inline">
                <input name="check" class="form-check-input" type="checkbox" id="" value="'.$el.'">
                <label class="form-check-label" for="inlineCheckbox1">'.$el.'</label>
            </div>
            
            ');
}

