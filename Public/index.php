<?php

$path = "/index";

if (isset($_SERVER['PATH_INFO'])) {
    $path = $_SERVER['PATH_INFO'];
}

require __DIR__ . "/../API" . $path . ".php";
