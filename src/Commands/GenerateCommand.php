<?php namespace LC\Commands;

use LC\Helper;
use LC\Presenters\ClassPresenter;
use LC\Presenters\IndexPresenter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command {

    protected function configure()
    {
        $this->setName('generate')->setDescription('Generate static html files for each contract');

        $this->addOption('path', null, InputOption::VALUE_OPTIONAL, 'Output directory', Helper::getConfig('classes'));
    }

    protected function generateClasses($path)
    {
        foreach(Helper::getContracts() as $group => $files)
        {
            foreach($files as $class)
            {
                $file = Helper::getClassDataAttribute($group, Helper::getClassName($class)) . '.html';

                file_put_contents($path.$file, (new ClassPresenter($group, $class))->getHtml('class.twig'));
            }
        }
    }

    protected function generateIndex()
    {
        file_put_contents(Helper::getConfig('dist').'index.html', (new IndexPresenter())->getHtml('index.twig'));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Generating HTML files...");

        $this->generateClasses($input->getOption('path'));

        $output->writeln("HTML files generated!");

        $output->writeln("Generating index.html file...");

        $this->generateIndex();

        $output->writeln("index.html generated!");

    }
}