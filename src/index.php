<?php
require(__DIR__ . '/../vendor/autoload.php');

$f3 = \Base::instance();

$f3->set('TEMP', __DIR__ . '/../tmp/');
$f3->set('UI', __DIR__ . '/Views/');
//$f3->set('DEBUG', 3);

$f3->route('GET /', '\MyApp\Controllers\MainController->index');
$f3->route('GET /comments', '\MyApp\Controllers\MainController->comments');
$f3->route('POST /add_comment', '\MyApp\Controllers\MainController->add_comment');

$f3->run();