<?php

namespace App\Command\GenerateGame;

use App\Entity\GameCapsule;
use App\Entity\GameCapsuleType;
use App\Entity\GameCharacter;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Yaml\Yaml;

class CapsuleCommand extends Command
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
            ->setName('game:generate:capsule')
            ->setDescription('Generate game capsule.')
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
        $capsuleType    = Yaml::parseFile('config/dataGame/capsulesType.yaml');
        $capsuleRepo    = $this->em->getRepository('App:GameCapsule');
        $typeRepository = $this->em->getRepository('App:GameCapsuleType');
        $typesExists    = $typeRepository->findAll();

        if (!$typesExists) {
            foreach ($capsuleType as $type) {
                foreach ($type as $slug => $details) {
                    $item = new GameCapsuleType();
                    $item->setName($details['name']);

                    $this->em->persist($item);
                }
            }
            $this->em->flush();
        }


        $capsules       = Yaml::parseFile('config/dataGame/capsules.yaml');

        $nbCapsuleAdd   = 0;


        foreach ($capsules as $capsule) {
            foreach ($capsule as $slug => $details) {
                if (!isset($details['type'])) {
                    foreach ($details as $character) {
                        $require = $this->em->getRepository('App:GameCharacter')->findOneBy(['slug' => $character['character']]);
                        if ($capsuleRepo->findOneBy(['slug' => $slug, 'character' => $require])) {
                            $output->writeln(['Capsule magie '.$slug.' pour '.$character['character'].' déjà ajouté']);
                            continue 1;
                        }

                        $item = $this->getCapsuleCompleted($slug, $character);
                        $this->em->persist($item);
                        $output->writeln(['Capsule : '.$slug.' pour : '.$character['character'].' ajoutée']);
                        $nbCapsuleAdd++;
                    }
                } else {
                    if ($capsuleRepo->findOneBy(['slug' => $slug])) {
                        $output->writeln(['Capsule déjà ajouté : '.$slug]);
                        continue 1;
                    }

                    $item = $this->getCapsuleCompleted($slug, $details);
                    $this->em->persist($item);
                    $output->writeln(['Capsule : '.$slug.' ajoutée.']);
                    $nbCapsuleAdd++;
                }
            }
        }

        if ($nbCapsuleAdd > 0) {
            $this->em->flush();
        }
        $output->writeln('Génération de capsule terminée.');
        $output->writeln($nbCapsuleAdd.' capsule'.(($nbCapsuleAdd > 1) ? 's' : '').' ajouté');
    }

    private function getCapsuleCompleted($slug, $details)
    {
        $item = new GameCapsule();

        foreach ($details as $property => $value) {
            if ($property === "type") {
                $type = $this->em->getRepository('App:GameCapsuleType')->findOneBy(['id' => $value]);
                $value = $type;
            } else if ($property === "character") {
                $character = $this->em->getRepository('App:GameCharacter')->findOneBy(['slug' => $value]);
                $value = $character;
            }

            $property = ucfirst($property);
            $method = "set".$property;
            $item->$method($value);
        }

        return $item;
    }
}
