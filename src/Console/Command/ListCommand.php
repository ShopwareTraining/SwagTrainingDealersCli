<?php declare(strict_types=1);

namespace SwagTraining\DealersCli\Console\Command;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('training:dealers:list')
            ->setDescription('Show a listing of all example dealers');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $table = new Table($output);
        $table->setHeaders(['ID', 'Name', 'Description', 'Address']);

        foreach ($this->getDealers() as $dealer) {
            $table->addRow([
                $dealer->getId(),
                $dealer->getName(),
                $dealer->getDescription(),
                $dealer->getAddress(),
            ]);
        }

        $table->render();
        return 0;
    }

    /**
     * @return EntityCollection
     */
    private function getDealers(): EntityCollection
    {
        $criteria = new Criteria;
        $context = Context::createDefaultContext();
        $searchResult = $this->dealerRepository->search($criteria, $context);
        return $searchResult->getEntities();
    }
}
