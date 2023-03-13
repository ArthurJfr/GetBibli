<?php

namespace Core\Helper;

class Debugger
{
    /**
     * @param $var
     * @return void
     */
    public static function debug($var) {
        echo '<pre style="height:100px;overflow-y: scroll;font-size:.8em;padding: 10px; font-family: Consolas, Monospace; background-color: #000; color: #fff;">';
        print_r($var);
        echo '</pre>';
    }
}