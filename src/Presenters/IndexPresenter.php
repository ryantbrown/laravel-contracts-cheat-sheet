<?php namespace LC\Presenters;

class IndexPresenter extends Presenter {

    public function getData()
    {
        return ['groups' => (new GroupPresenter())->getHtml('group.twig')];
    }

}