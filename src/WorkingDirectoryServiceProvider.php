<?php

namespace Devdot\Cli\DirectoryProject;

use Devdot\Cli\Container\ServiceProvider;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class WorkingDirectoryServiceProvider extends ServiceProvider
{
    public function booting(ContainerBuilder $container): void
    {
        parent::booting($container);

        $container->autowire(WorkingDirectoryInterface::class, WorkingDirectoryInterface::class)->setFactory([WorkingDirectory::class, 'fromCwd']);
    }
}
