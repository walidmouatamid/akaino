<?php

$args = $argv;

$action = "";
$value = "";


if(isset($args[1])) $action = $args[1];
if(isset($args[2])) $value = $args[2];

switch ($action){

    case 'generate_view':
        file_put_contents("View/$value.akaino.php", "$value View, edit content from View/$value.akaino.php");
        break;

    default:
        echo "Option invalid!";

}