<?php
declare(strict_types=1);

namespace Raj;

use Exception;
use League\CLImate\CLImate;
use Raj\Command;

/**
 * Class Raj
 * @package Raj
 */
final class Raj extends RajStyle
{
    /**
     * @var array|null
     */
    protected ?array $commands;
    /**
     * @var string
     */
    protected string $root;
    /**
     * @var array
     */
    protected array $argv;
    /**
     * @var CLImate
     */
    protected CLImate $climate;
    /**
     * @var int
     */
    protected int $argumentsCount;

    /**
     * Raj constructor.
     * @param string $root
     * @param array $argv
     * @param CLImate $climate
     */
    public function __construct(string $root, array $argv, CLImate $climate)
    {
        $this->root = $root;
        $this->argv = $this->sliceFirst($argv);
        $this->argumentsCount = count($this->argv); 
        $this->climate = $climate;
        $this->commands = [];
    }

    /**
     *
     */
    public function execute() : void
    {
        $command = $this->argv[0];
        if (!isset($this->argv[1])) {
            $this->error(
                'Please, entry a command action.',
                'php raj generate',
                'php raj generate controller'
            );   
        }

        $method = $this->argv[1];

        $params = array_slice($this->argv, 2);
        $is = false;
        foreach ($this->commands as $registeredCommand) {
            $is = !($command == $registeredCommand->arguments[0]) ?? true;
            
            if (isset($registeredCommand->arguments[1]))
                $is = !($command == $registeredCommand->arguments[1]) ?: true;

            if ($is && method_exists($registeredCommand, $method)) {
                $registeredCommand->{$method}(...$params);
                die();
            }
        }
        $this->error('Action does not exist.');
    }

    /**
     * @param \Raj\Command $command
     */
    public function add(Command $command) : void
    {
        $this->commands[] = $command;
    }

    /**
     *
     */
    public function start(): void
    {
        if ($this->argumentsCount == 0 || $this->argv[0] == '-h' || $this->argv[0] == '--help'):
            $this->commandSummary();
        else:
            $this->execute();
        endif;
    }

    /**
     * @param array $argv
     * @return array
     */
    public function sliceFirst(array $argv) : array
    {
        return array_slice($argv, 1);
    }

    /**
     * @param string $message
     * @param string|null $wrong
     * @param string|null $right
     */
    private function error(string $message, string $wrong = null, string $right = null) : void
    {
        $this->climate->backgroundRed()->text("\n $message");
        if ($wrong != null && $right != null) {
            $this->climate->yellow()->text("\nWrong: " . $wrong);
            $this->climate->green()->text('Right: ' . $right);    
        }
        $this->climate->cyan()->text("\nquestions ~> php raj --help\n");
        die();
    }
}