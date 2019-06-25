<?php

namespace App\Command\GenerateGame;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\GameLevel;

class LevelCommand extends Command
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
            ->setName('game:generate:level')
            ->setDescription('Generate game level.')
            ->setDefinition(array(
                new InputArgument('level_max', InputArgument::REQUIRED, 'The level max to generate'),
            ))
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
        $level_max = $input->getArgument('level_max');

        $level_one = new GameLevel();
        $level_one->setExperienceRequired(0)
            ->setLevel(1);

        $this->em->persist($level_one);
        $this->em->flush();

        $exp_required = 10000;
        $exp_add = 0;
        for ($i = 2; $i <= $level_max; $i++) {
            $level = new GameLevel();
            $level->setLevel($i)
                  ->setExperienceRequired($exp_required);

            $this->em->persist($level);

            $exp_add += 9000 * ($i % 5);
            $exp_required = ceil($exp_required + $exp_add);
            $output->writeln(sprintf('Level %d generated', $i));
        }
        $this->em->flush();
    }

    /**
     *
     * {@inheritdoc}
     *
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $questions = array();

        if (!$input->getArgument('level_max')) {
            $question = new Question('Saissisez jusqu\'a quel niveau : ');
            $questions['level_max'] = $question;
        }

        foreach ($questions as $name => $question) {
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument($name, $answer);
        }
    }
}
