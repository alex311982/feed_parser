<?php

try {
    require __DIR__.'/../bootstrap.php';

    $container->get('app')->run();
} catch (\Exception $e) {
    echo $e->getMessage();
    echo PHP_EOL;
}
