<?php
declare(strict_types=1);

namespace Raj;

/**
 * Class RajStyle
 * @package Raj
 */
abstract class RajStyle
{
    protected function commandSummary() : void
    {
        $this->climate->green()->text("Raj, the Lazlo's Command Line Interface\n");
        $this->renderSummary();
        echo "\n";
    }

    protected function renderSummary() : void
    {
        foreach ($this->commands as $command) {
            $methods = get_class_methods($command);
            $this->climate->yellow()->columns([implode(', ', $command->arguments)]);
            foreach ($methods as $method) {
                $this->climate->cyan()->columns([[$method, $command->descriptions[$method]]]);
            }
        }
    }
}