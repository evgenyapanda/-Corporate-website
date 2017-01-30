<?php

namespace Corp\Repositories;

use Config;

abstract class  Repository{

    protected $model = false;

    public function get($select = '*', $take = false){

        $builder = $this->model->select($select);//select - указывает какие поля нужно выбрать из БД

        if($take){
            $builder->take($take);
        }

        return $builder->get();
    }



}