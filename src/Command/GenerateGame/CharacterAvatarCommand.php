<?php

namespace App\Command\GenerateGame;

use App\Entity\GameCharacter;
use App\Entity\GameCharacterAvatar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Yaml\Yaml;

class CharacterAvatarCommand extends Command
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
            ->setName('app:game:generate:character-Avatar')
            ->setDescription('Generate game avatar for character.')
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
        $charactersAvatar = Yaml::parseFile('config/dataGame/characterAvatar.yaml');

        $gameCharacterRepository = $this->em->getRepository('App:GameCharacter');

        foreach ($charactersAvatar as $character => $details) {
            /** @var GameCharacter $currChar */
            $currChar = $gameCharacterRepository->findOneBy(['slug' => $character]);

            foreach ($details as $level => $name) {
                if(preg_match('/([0-9]{1,})-([0-9]{1,})/', $level,$result)) {
                    $min = $result[1];
                    $max = $result[2];

                    for ($i = $min; $i <= $max; $i++) {
                        $gameCharacterAvatar = new GameCharacterAvatar();
                        $gameCharacterAvatar->setLevel($i)
                                            ->setImage($name.".jpg")
                                            ->setCharacterid($currChar->getId());
                        $this->em->persist($gameCharacterAvatar);
                    }
                }
            }

            $this->em->flush();
            $output->writeln('Data character avatar created for '.$currChar->getName());
        }

        $output->writeln('Generating character avatar done.');
    }
}
