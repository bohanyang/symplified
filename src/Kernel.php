<?php

declare(strict_types=1);

namespace App;

use Psr\Container\ContainerInterface;
use Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel;

use function dirname;

class Kernel extends AbstractSymplifyKernel
{
    /** @param string[] $configFiles */
    public function createFromConfigs(array $configFiles): ContainerInterface
    {
        $configFiles[] = dirname(__DIR__) . '/config/services.php';

        return $this->create($configFiles);
    }
}
