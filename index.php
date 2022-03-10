<?php

spl_autoload_register(function ($class_name) {

    $search = ['\\'];
    $replace = ['/'];

    $path = str_replace($search, $replace, $class_name . '.php');

    $path_adapter = explode('/', $path);
    unset($path_adapter[0]);

    $path = implode('/', $path_adapter);

    require __DIR__ . '/' . $path;
});

require_once __DIR__ . '/tz-extended.php';
