<?php namespace LC\Presenters;

abstract class Presenter {

    protected $twig;
    protected $templates;

    public function __construct()
    {
        $this->templates = __DIR__ . '/../../assets/templates';

        $this->twig = new \Twig_Environment(new \Twig_Loader_Filesystem($this->templates));
    }

    public function getHtml($template)
    {
        return $this->twig->render($template, $this->getData());
    }

    abstract public function getData();

}