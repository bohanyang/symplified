<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Application;
use App\Calculator;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Command\Command;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services
        ->defaults()
        ->public()
        ->autowire()
        ->autoconfigure();

    $services->instanceof(Command::class)
        ->tag('console.command');

    $services
        ->load('App\\', __DIR__ . '/../src/')
        ->exclude([
            __DIR__ . '/../src/Kernel.php',
        ]);

    $services->alias(ConsoleApplication::class, Application::class);

    $services->set(Calculator::class)
        ->arg('$overflow', env('OVERFLOW')->int());
};
