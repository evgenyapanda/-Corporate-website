<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenusRepository;
use Corp\Http\Requests;
use Illuminate\Http\Request;
use Menu;

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

    public function __construct(MenusRepository $m_rep) //$m_rep содержит объект MenusRepository
    {
        $this->m_rep = $m_rep;
    }

    /**
     * @return mixed
     */
    protected function renderOutput(){

        $menu = $this->getMenu();


        $navigation = view(env('THEME').'.layouts.navigation')->with('menu', $menu)->render();//преобразует шаблон в строку
        $this->vars = array_add($this->vars,'navigation', $navigation);
        return view($this->template)->with($this->vars); //вызывается шаблон и в него передаються переменные
    }

    protected function getMenu(){
        $menu = $this->m_rep->get();


        $menuBuilder = Menu::make('MyNav', function($menuItem) use($menu){

            foreach ($menu as $item){

                if($item->parent == 0){ //если в таблице поле parent 0
                    $menuItem->add($item->title, $item->path)->id($item->id);
                    //добавляем новый пункт меню
                    // выводим значение поля title из БД и значение path (ссылка)
                    //через свойство id выводим id пункта меню
                }
                else{
                    if($menuItem->find($item->parent)){ //find используеться для поиска интересующего пункта меню по id
                        $menuItem->find($item->parent)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });



        return $menuBuilder;
    }
}
