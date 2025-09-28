<?php

namespace Devdot\Cli\DirectoryProject;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Filesystem\Path;

/**
 * @mixin \Devdot\Cli\Command
 *
 */
trait WorkingDirectoryTrait
{
    private WorkingDirectoryInterface $_workingDirectoryInterface;

    public function __constructWorkingDirectoryTrait(): void
    {
        $this->addOption('working-dir', null, InputOption::VALUE_REQUIRED, 'Set the working directory.', '.');
    }

    protected function getWorkingDirectoryInterface(): WorkingDirectoryInterface
    {
        if (!isset($this->_workingDirectoryInterface)) {
            $workingDir = $this->input->getOption('working-dir');
            assert(is_string($workingDir));

            $this->_workingDirectoryInterface = empty($workingDir) ? WorkingDirectory::fromCwd() : new WorkingDirectory($workingDir);
        }
        return $this->_workingDirectoryInterface;
    }

    protected function getWorkingDirectory(): string
    {
        return $this->getWorkingDirectoryInterface()->getWorkingDirectory();
    }

    protected function isInWorkingDirectory(string $absolute): bool
    {
        return $this->getWorkingDirectoryInterface()->isInWorkingDirectory($absolute);
    }

    /**
     * Make a given absolute path relative to the the base directory
     */
    protected function getRelativeToWorkingDirectory(string $path): string
    {
        return $this->getWorkingDirectoryInterface()->getRelativeToWorkingDirectory($path);
    }

    /**
     * Make a given relative path absolute using base directory
     */
    protected function getAbsoluteInWorkingDirectory(string $path): string
    {
        return $this->getWorkingDirectoryInterface()->getAbsoluteInWorkingDirectory($path);
    }

    protected function formatInWorkingDirectory(string $path, string $prefix = '.' . DIRECTORY_SEPARATOR): string
    {
        return $this->getWorkingDirectoryInterface()->formatInWorkingDirectory($path, $prefix);
    }
}
