<?php

try {
    require __DIR__.'/../bootstrap.php';

    $container->get('app')->run();
} catch (\Throwable $e) {
    $container->get('app.logger')->err($e->getCode() . ':' . $e->getFile() . ':' . $e->getLine() . ':' . $e->getMessage());
}
