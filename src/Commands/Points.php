<?php
namespace ImagineEasy\OpenScrum\Commands;

use Symfony\Component\Console;
use ImagineEasy\OpenScrum\Service;

class Points extends Console\Command\Command
{
    protected function configure()
    {
        $this
            ->setName('points')
            ->setDescription('Pull points!')
            ->addArgument(
                'repository',
                Console\Input\InputArgument::REQUIRED,
                'The github repository'
            )
            ->addArgument(
                'milestone',
                Console\Input\InputArgument::REQUIRED,
                'The milestone'
            )
            ->addOption(
                'state',
                's',
                Console\Input\InputOption::VALUE_REQUIRED,
                'Options: closed, open'
            )
        ;
    }

    protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
    {
        $repository = $input->getArgument('repository');
        $milestone = $input->getArgument('milestone');
        $state = $input->getOption('state');

        if (!$this->isValidState($state)) {
            throw new \InvalidArgumentException("Wrong state.");
        }

        $config = require ROOT_DIR . '/etc/config.php';

        $search = new Service\Search(
            $repository,
            $milestone,
            $state,
            $config['token']
        );

        $issues = $search->getIssues();

        $presenter = new Service\Presenter($issues);
        $presenter->filter()->presentCSV($milestone, $state);
    }

    private function isValidState($state)
    {
        if (in_array($state, ['all', 'closed', 'open'])) {
            return true;
        }

        return false;
    }
}