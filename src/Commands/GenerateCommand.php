<?php namespace LC\Commands;

use LC\Helper;
use LC\Presenters\ClassPresenter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command {

    protected $name = 'generate';
    protected $description = 'Generate static html files for each contract';

    protected function configure()
    {
        $this->setName($this->name)->setDescription($this->description);

        $this->addOption('path', null, InputOption::VALUE_OPTIONAL, 'Output directory', Helper::getStaticClassesPath());
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getOption('path');

        $output->writeln("Generating html files...");

        foreach(Helper::getContracts() as $group => $files)
        {
            foreach($files as $class)
            {
                $file = Helper::getClassDataAttribute($group, Helper::getClassName($class)) . '.html';

                file_put_contents($path.$file, (new ClassPresenter($group, $class))->getHtml('class.twig'));
            }
        }

        $output->writeln("Complete!");
    }
}