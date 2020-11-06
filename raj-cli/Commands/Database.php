<?php

namespace Raj\Commands;
use Raj\Command;

class Database extends Command
{
    public array $arguments = ['database', 'db'];
    public array $descriptions = [
        'migrate' => 'transfer the .sql migrations to database',
    ];

    public function migrate()
    {
        # code...
    }
} 