<?php

declare(strict_types=1);

namespace App\Command;

use App\Calculator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add',
)]
final class AddCommand extends Command
{
    public function __construct(
        private Calculator $calculator,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('a', InputArgument::REQUIRED, 'Left hand')
            ->addArgument('b', InputArgument::REQUIRED, 'Right hand');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $a = (int) $input->getArgument('a');
        $b = (int) $input->getArgument('b');

        $output->writeln('The result is: ' . $this->calculator->add($a, $b));

        return Command::SUCCESS;
    }
}
