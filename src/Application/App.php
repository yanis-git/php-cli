<?php

declare(strict_types=1);

namespace App\Application;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Traversable;

class App extends Application
{
    /**
     * @param iterable<Command> $commands
     */
    public function __construct(iterable $commands)
    {
        $commands = $commands instanceof Traversable ? iterator_to_array($commands) : $commands;

        foreach ($commands as $command) {
            $this->add($command);
        }

        parent::__construct();
    }
}
