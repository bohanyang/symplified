<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

use function is_array;
use function iterator_to_array;

final class Application extends ConsoleApplication
{
    public function __construct(#[TaggedIterator('console.command')] iterable $commands)
    {
        $this->addCommands(is_array($commands) ? $commands : iterator_to_array($commands));
        parent::__construct();
    }
}
