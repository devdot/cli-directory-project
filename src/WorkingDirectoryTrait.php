<?php

namespace Devdot\Cli\DirectoryProject;

use Symfony\Component\Console\Input\InputOption;

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
        return $this->getWorkingDirectoryInterface()->get();
    }
}
