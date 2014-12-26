#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

$console = new Symfony\Component\Console\Application();
$console->add(new LC\Commands\GenerateCommand());
$console->run();

