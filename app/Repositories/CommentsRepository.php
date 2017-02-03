<?php

namespace Corp\Repositories;

use Corp\Comment;

class CommentsRepository extends Repository{

    public function __construct(Comment $comment) //переменная меню, которая содержит объект меню
    {
        $this->model = $comment;
    }

}