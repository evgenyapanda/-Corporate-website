<?php

namespace Corp\Repositories;

use Config;

abstract class  Repository{

    protected $model = false;

    public function get($select = '*', $take = false, $pagination = false){

        $builder = $this->model->select($select);//select - указывает какие поля нужно выбрать из БД

        if($take){
            $builder->take($take);
        }

        if($pagination){
            return $builder->paginate(Config::get('settings.paginate'));
        }

        return $builder->get();
    }



}