<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\Console\Application;

use function array_filter;
use function assert;

final class RuntimeResolvable
{
    public function __invoke(): Application
    {
        $kernel = new Kernel();

        $container = $kernel->createFromConfigs(
            // extra configs
            [],
        );

        $application = $container->get(Application::class);
        assert($application instanceof Application);
        // remove --no-interaction (with -n shortcut) option from Application
        // because we need to create option with -n shortcuts too
        // for example: --dry-run with shortcut -n
        $inputDefinition = $application->getDefinition();

        $options = $inputDefinition->getOptions();
        $options = array_filter($options, static fn ($option): bool => $option->getName() !== 'no-interaction');

        $inputDefinition->setOptions($options);

        return $application;
    }
}
