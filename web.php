<?php
require_once __DIR__ . '/vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', function () {
    return 'Hello world';
});
