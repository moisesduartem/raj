# Raj CLI

Raj it's a Composer component to add your helpers and repetitives terminal commands to a smart and friendly command line interface.

# Installation
```
composer require lazlo/raj
```
# First Usage

1 - Import composer autoload 
```
require_once __DIR__ . '/path/to/vendor/autoload.php';
```

2 - Import necessary packages
```
use League\CLImate\CLImate;
use Raj\Raj;
```

3 - Create a command class
```
example: Run.php

namespace Raj\Commands;
use Raj\Command;

class Run extends Command
{
    public array $arguments = ['serve', 's'];
    public array $descriptions = [
        'serve' => 'start a built-in php server',
    ];

    public function serve()
    {
        echo `php -S localhost:8000 -t public/`;
    }
} 
```

4 - Instanciate `Raj\Raj ` class passing `__DIR__`, `$argv` and a instance of `League\CLImate\CLImate`

```
$raj = new Raj(__DIR__, $argv, new CLImate);
```

5 - Add your Raj commands one by one with `Raj::add` method

```
$raj->add(new Run());
```

6 - And start Raj!

```
$raj->start();
```

7 - Now if you put `php raj`, `php raj -h` or `php raj --help`, you i'll see your commands and will be able to execute them!

---
- Moisés Mariano 
- [Raj Project](http://github.com/moisesduartem/raj)
- [PHP League CLImate Library](https://climate.thephpleague.com/)