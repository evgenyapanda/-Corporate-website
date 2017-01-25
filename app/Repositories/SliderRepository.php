<?php

namespace Corp\Repositories;

use Corp\Slider;

class SliderRepository extends Repository{

    public function __construct(Slider $slider) //переменная меню, которая содержит объект меню
    {
        $this->model = $slider;
    }

}