<?php

session_start();

if(isset($_SESSION['history'])){
    echo($_SESSION['history']);
}
