<?php

namespace Devdot\Cli\DirectoryProject;

interface WorkingDirectoryInterface
{
    public function getWorkingDirectory(): string;
    public function isInWorkingDirectory(string $absolute): bool;
    public function getRelativeToWorkingDirectory(string $path): string;
    public function getAbsoluteInWorkingDirectory(string $path): string;
    public function formatInWorkingDirectory(string $path, string $prefix): string;
}
