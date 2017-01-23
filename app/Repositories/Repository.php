<?php

namespace Corp\Repositories;

use Config;

abstract class  Repository{

    protected $model = false;

    public function get(){

        $builder = $this->model->select('*');//select - указывает какие поля нужно выбрать из БД


        return $builder->get();
    }

}