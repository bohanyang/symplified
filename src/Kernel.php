<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symplify\AutowireArrayParameter\DependencyInjection\CompilerPass\AutowireArrayParameterCompilerPass;
use Symplify\SymplifyKernel\Config\Loader\ParameterMergingLoaderFactory;
use Symplify\SymplifyKernel\ContainerBuilderFactory;
use Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel;
use Symplify\SymplifyKernel\ValueObject\SymplifyKernelConfig;

use function dirname;

final class Kernel extends AbstractSymplifyKernel
{
    /**
     * @param string[]                $configFiles
     * @param CompilerPassInterface[] $compilerPasses
     * @param ExtensionInterface[]    $extensions
     */
    public function create(array $configFiles, array $compilerPasses = [], array $extensions = []): ContainerInterface
    {
        $containerBuilderFactory = new ContainerBuilderFactory(new ParameterMergingLoaderFactory());

        $compilerPasses[] = new AutowireArrayParameterCompilerPass();

        $configFiles[] = SymplifyKernelConfig::FILE_PATH;

        $containerBuilder = $containerBuilderFactory->create($configFiles, $compilerPasses, $extensions);
        $containerBuilder->compile(true);

        $this->container = $containerBuilder;

        return $containerBuilder;
    }

    /** @param string[] $configFiles */
    public function createFromConfigs(array $configFiles = []): ContainerInterface
    {
        $configFiles[] = dirname(__DIR__) . '/config/services.php';

        return $this->create($configFiles);
    }
}
