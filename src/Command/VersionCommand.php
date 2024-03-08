<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:version',
    description: 'start new processing and monitor it',
    aliases: ['version']
)]
class VersionCommand extends Command
{
    public function __construct(
        private readonly string $version,
        private readonly string $baseDir,
        ?string                 $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(sprintf('<info>Version: %s</info>', $this->version));
        $output->writeln(sprintf('<info>Base Dir: %s</info>', $this->baseDir));

        return Command::SUCCESS;
    }
}
