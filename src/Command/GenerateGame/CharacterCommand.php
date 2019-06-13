<?php

namespace App\Command\GenerateGame;

use App\Entity\GameCharacter;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\GameLevel;
use Symfony\Component\Yaml\Yaml;

class CharacterCommand extends Command
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
            ->setName('app:game:generate:character')
            ->setDescription('Generate game character.')
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
        $characters = Yaml::parseFile('config/dataGame/characters.yaml');

        foreach ($characters as $character) {
            foreach ($character as $slug => $details) {
                $item = new GameCharacter();
                $item->setName($details['name'])
                     ->setIcon($slug.'.gif')
                     ->setAlternative($details['alt']);

                $this->em->persist($item);
            }
        }

        $this->em->flush();

        $output->writeln('Génération de personnage terminé.');
    }
}
