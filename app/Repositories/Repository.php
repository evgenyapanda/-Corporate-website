<?php

namespace Corp\Repositories;

use Config;

abstract class  Repository{

    protected $model = false;

    public function get($select = '*', $take = false, $pagination = false, $where = false){

        $builder = $this->model->select($select);//select - указывает какие поля нужно выбрать из БД

        if($take){
            $builder->take($take);
        }



        if($where){
            $builder->where($where[0], $where[1]);
        }

        if($pagination){
            return $builder->paginate(Config::get('settings.paginate'));
        }


        return $builder->get();
        //return $this->check($builder->get());
    }

    /*protected function check($result){
        if($result->isEmpty()){
            return false;
        }
        $result->transform(function($item, $key){
            $item->img = json_decode($item->img);
            return $item;
        });

    }*/

    public function one($alias, $attr = array()){

       $result = $this->model->where('alias', $alias)->first();

        return $result;

    }



}