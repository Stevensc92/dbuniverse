<?php

namespace App\Command\GenerateGame;

use App\Entity\GameMapAction;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Yaml\Yaml;

class mapActionCommand extends Command
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:game:generate:map-action')
            ->setDescription('Generate game map action.')
            ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $map = Yaml::parseFile('config/dataGame/mapAction.yaml');

        foreach ($map as $action) {
            foreach ($action as $slug => $details) {
                $mapAction = new GameMapAction();
                $mapAction->setSlug($slug)
                          ->setName($details['name'])
                          ->setX($details['x'])
                          ->setY($details['y']);

                $this->em->persist($mapAction);
            }
        }

        $this->em->flush();

        $output->writeln('Génération de map action terminé.');
    }
}
