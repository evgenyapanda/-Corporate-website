<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenusRepository;
use Corp\Http\Requests;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    protected  $p_rep;
    protected  $s_rep;
    protected  $a_rep;
    protected  $m_rep;

    protected $template; //шаблон сайта

    protected $vars = array(); //переменные

    protected  $contentRightBar = FALSE;
    protected  $contentLeftBar = FALSE;

    protected $bar = false;

    public function __construct(MenusRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }

    protected function renderOutput(){

        $menu = $this->getMenu();

     

        $navigation = view(env('THEME').'.layouts.navigation')->render();
        $this->vars = array_add($this->vars,'navigation', $navigation);
        return view($this->template)->with($this->vars); //вызывается шаблон и в него передаються переменные
    }

    protected function getMenu(){
        $menu = $this->m_rep->get();
        return $menu;
    }
}
