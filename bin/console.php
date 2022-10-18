<?php

declare(strict_types=1);

namespace App;

use Symplify\SymplifyKernel\ValueObject\KernelBootAndApplicationRun;

use function dirname;

require dirname(__DIR__) . '/vendor/autoload.php';

$kernelBootAndApplicationRun = new KernelBootAndApplicationRun(Kernel::class);
$kernelBootAndApplicationRun->run();
