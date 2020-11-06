<?php

namespace Raj\Commands;
use Raj\Command;

class Generate extends Command
{
    public array $arguments = ['generate', 'g'];
    public array $descriptions = [
        'controller' => 'create a controller class',
        'migration' => 'create a migration .sql file'
    ];

    public function controller(string $controllerName)
    {
        echo $controllerName;
    }

    public function migration(string $migrationName, ...$columns)
    {
        print_r([$migrationName, $columns]);
    }
} 