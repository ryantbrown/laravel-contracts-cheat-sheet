<?php namespace LC\Presenters;

use LC\Helper;
use Twig_Environment;
use Twig_Loader_Filesystem;

abstract class Presenter {

    protected $twig;

    public function __construct()
    {
        $this->twig = new Twig_Environment(new Twig_Loader_Filesystem(Helper::getConfig('templates')));
    }

    public function getHtml($template)
    {
        return $this->twig->render($template, $this->getData());
    }

    abstract public function getData();

}