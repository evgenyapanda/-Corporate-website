<?php

namespace Corp\Repositories;

use Corp\Category;

class CategoriesRepository extends Repository{

    public function __construct(Category $categories) //переменная меню, которая содержит объект меню
    {
        $this->model = $categories;
    }

}