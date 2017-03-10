<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Http\Controllers\Admin\AdminController;

class IndexController extends AdminController

{
    //
    public function __construct()
    {
        $this->template = env('THEME').'.admin.index';

    }

    public function index(){
        $this->title = 'Admin panel';

        return $this->renderOutput();
    }
}
