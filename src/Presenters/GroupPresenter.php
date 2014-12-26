<?php namespace LC\Presenters;

use LC\Helper;

class GroupPresenter extends Presenter {

    public function getData()
    {
        return ['contracts' => Helper::getContracts()];
    }

}