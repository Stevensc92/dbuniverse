<?php

namespace App\Command\GenerateGame;

use App\Entity\GameCapsule;
use App\Entity\GameCapsuleLevel;
use App\Entity\GameCapsuleType;
use App\Entity\GameCharacter;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Yaml\Yaml;

class CapsuleLevelCommand extends Command
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
            ->setName('game:generate:capsule:level')
            ->setDescription('Generate game capsule level.')
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
        $capsulesLevel    = Yaml::parseFile('config/dataGame/capsuleLevel.yaml');
        $typeRepository = $this->em->getRepository(GameCapsuleType::class);

        foreach ($capsulesLevel as $level => $types) {
            foreach ($types as $type => $details) {
                $item = new GameCapsuleLevel();
                $item->setType($typeRepository->find($type))
                     ->setLevel($level)
                     ->setExpRequired($details['exp'])
                     ->setBonus($details['bonus']);

                $this->em->persist($item);
            }
        }
        $this->em->flush();
    }
}
