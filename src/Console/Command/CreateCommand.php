<?php declare(strict_types=1);

namespace SwagTraining\DealersCli\Console\Command;

use Shopware\Core\Framework\Context;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends AbstractCommand
{
    /**
     * Configure this command
     */
    protected function configure()
    {
        $this->setName('training:dealers:create')
            ->setDescription('Create a new example dealer')
            ->addOption('name', null, InputOption::VALUE_OPTIONAL, 'Name')
            ->addOption('description', null, InputOption::VALUE_OPTIONAL, 'Description')
            ->addOption('address', null, InputOption::VALUE_OPTIONAL, 'Address');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = [];
        $data['name'] = $this->getValueFromInput($input, $output, 'name');
        $data['description'] = $this->getValueFromInput($input, $output, 'description');
        $data['address'] = $this->getValueFromInput($input, $output, 'address');

        $context = Context::createDefaultContext();
        $this->dealerRepository->upsert([$data], $context);

        $output->writeln('Create new dealer record');
    }
}