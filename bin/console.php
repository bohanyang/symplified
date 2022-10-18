<?php

declare(strict_types=1);

if (! is_file(dirname(__DIR__) . '/vendor/autoload_runtime.php')) {
    throw new LogicException('Symfony Runtime is missing. Try running "composer require symfony/runtime".');
}

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';
