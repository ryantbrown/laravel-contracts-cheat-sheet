<?php namespace LC\Presenters;

use LC\Helper;

class ClassPresenter extends Presenter {

    protected $group;
    protected $class;

    public function __construct($group, $class)
    {
        $this->group = $group;
        $this->class = $class;

        parent::__construct();
    }

    public function getData()
    {
        $reflector = Helper::getReflector($this->group, $this->class);

        return [
            'namespace' => Helper::getClassNamespace($this->group, $this->class),
            'constants' =>  $reflector->getConstants(),
            'methods' => $reflector->getMethodData()
        ];
    }

}