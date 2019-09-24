<?php

function debug()
{
    $args = func_get_args();
    foreach ($args as $arg) {
        echo '<pre>' . print_r($arg, true) . '</pre>';
    }
}