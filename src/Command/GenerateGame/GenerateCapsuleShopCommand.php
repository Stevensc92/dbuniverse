<?php

namespace App\Command\GenerateGame;

use App\Entity\GameCapsule;
use App\Entity\GameCapsuleType;
use App\Entity\GameCharacter;
use App\Services\CapsuleCorp;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Yaml\Yaml;

class GenerateCapsuleShopCommand extends Command
{
    private $em,
            $capsuleCorp;

    public function __construct(EntityManagerInterface $em, CapsuleCorp $capsuleCorp)
    {
        $this->em = $em;
        $this->capsuleCorp = $capsuleCorp;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('game:generate:shop:capsule')
            ->setDescription('Generate game shop capsule.')
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
        if ($this->capsuleCorp->generateShop() ) {
            $output->writeln(['La capsule corp a bien été réinitialisé.']);
        }
    }
}
