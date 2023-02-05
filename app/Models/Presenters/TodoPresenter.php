<?php

namespace App\Models\Presenters;

use TheHiveTeam\Presentable\Presenter;

class TodoPresenter extends Presenter
{
    /**
    * This is a example.
    *
    * @return string
    */
    public function name()
    {
        return ucwords($this->model->name);
    }
}
