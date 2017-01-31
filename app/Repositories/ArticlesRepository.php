<?php

namespace Corp\Repositories;

use Corp\Article;

class ArticlesRepository extends Repository{

    public function __construct(Article $articles) //переменная меню, которая содержит объект меню
    {
        $this->model = $articles;
    }

}