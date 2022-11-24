<?php

use app\controllers\MainController;
require 'vendor/autoload.php';

try {
    $controller = new MainController();

    $result = $controller->actionParse();

    print $result;
} catch (Throwable $exception) {
    print $exception->getMessage() . "\n";
}
