<?php

namespace Devdot\Cli\DirectoryProject;

use Stringable;

interface WorkingDirectoryInterface extends Stringable
{
    public function get(): string;
    public function isSubPath(string $absolute): bool;
    public function makeRelative(string $absolute): string;
    public function makeAbsolute(string $relative): string;
    public function formatPath(string $path, string $prefix): string;
}
