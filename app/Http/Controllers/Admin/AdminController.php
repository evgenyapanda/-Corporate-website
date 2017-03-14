<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;

use Auth;
use Menu;


class AdminController extends \Corp\Http\Controllers\Controller
{
    //
    protected $p_rep; //свойство для хранения репозитория портфолио репозитория (объект портфолио репозиторий)
    protected $a_rep; //для артиклов
    protected $user; //для хранения объекта аунтифицированых пользователей
    protected $template; //для шаблона
    protected $content = false; //основной контент
    protected $title; //заголовок конкретной страницы
    protected $vars;

    public function __construct()
    {
        $this->user = Auth::user();


        if(!$this->user){
            abort(403);
        }
    }

    public function renderOutput(){


        $this->vars = array_add($this->vars, 'title', $this->title);

        $menu = $this->getMenu();

        $navigation = view(env('THEME').'.admin.navigation')->with('menu', $menu)->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        if($this->content){
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        $footer = view(env('THEME').'.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }

    public function getMenu(){
        return Menu::make('adminMenu', function($menu){

            /*$menu->add('Статьи', array('route' => 'admin.articles.index'));
            $menu->add('Портфолио', array('route' => 'admin.articles.index'));
            $menu->add('Меню', array('route' => 'admin.articles.index'));
            $menu->add('Пользователи', array('route' => 'admin.articles.index'));
            $menu->add('Привелегии', array('route' => 'admin.articles.index'));*/
        });
    }
}
