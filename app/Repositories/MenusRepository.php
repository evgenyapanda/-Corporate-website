<?php

namespace Corp\Repositories;

use Corp\Menu;

class MenusRepository extends Repository{

    public function __construct(Menu $menu) //переменная меню, которая содержит объект меню
    {
        $this->model = $menu;
    }

}