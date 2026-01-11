<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Console;

use App\Kernel\Kernel;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'app:modules:list',
    description: 'List all registered application modules',
)]
final class ListModulesCommand extends Command
{
    public function __construct(
        private readonly KernelInterface $kernel,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if (!$this->kernel instanceof Kernel) {
            $io->error('This command requires App\Kernel instance');
            return Command::FAILURE;
        }

        $modules = $this->kernel->getModules();

        if (empty($modules)) {
            $io->warning('No modules registered');
            return Command::SUCCESS;
        }

        $io->title('Registered Application Modules');

        $rows = [];
        foreach ($modules as $module) {
            $rows[] = [
                $module->getName(),
                get_class($module),
                $module->getPath(),
                implode(', ', $module->getConfigFiles()),
                implode(', ', $module->getRouteFiles()),
            ];
        }

        $io->table(
            ['Name', 'Class', 'Path', 'Config Files', 'Route Files'],
            $rows
        );

        $io->success(sprintf('Found %d module(s)', count($modules)));

        return Command::SUCCESS;
    }
}
