<?php

namespace Core\Service;

use Core\Kernel\Config;

class Log
{
    public function logWrite(string $data)
    {
        $directory = $_SERVER['DOCUMENT_ROOT'] . '/../var/log/';
        $file = date('Y-m-d') . ".log";
        $path = $directory . $file;
        $data = date('H:i:s') . " - " . $data;
        $handle = fopen($path, "a");
        if (flock($handle, LOCK_EX)) {
            fwrite($handle, $data . PHP_EOL);
            flock($handle, LOCK_UN);
        }
        fclose($handle);
    }
}
