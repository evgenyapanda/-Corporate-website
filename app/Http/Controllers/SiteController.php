<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenusRepository;
use Corp\Http\Requests;
use Illuminate\Http\Request;
use Menu;

class SiteController extends Controller
{
    //
    protected  $p_rep;  //portfolio
    protected  $c_rep;  //comments
    protected  $a_rep; //sitebar
    protected  $m_rep; //menu

    protected $keywords;
    protected $meta_desc;
    protected $title;

    protected $template; //шаблон сайта

    protected $vars = array(); //переменные

    protected  $contentRightBar = FALSE;
    protected  $contentLeftBar = FALSE;

    protected $bar = 'no';

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

        if($this->contentRightBar){
            $rightBar = view(env('THEME').'.rightBar')->with('content_rightBar', $this->contentRightBar)->render();
            $this->vars = array_add($this->vars,'rightBar', $rightBar);
        }

        $this->vars = array_add($this->vars,'bar', $this->bar);

        $this->vars = array_add($this->vars, 'keywords', $this->keywords);
        $this->vars = array_add($this->vars, 'meta_desc', $this->meta_desc);
        $this->vars = array_add($this->vars, 'title', $this->title);

        $footer = view(env('THEME').'.footer')->render();
        $this->vars = array_add($this->vars,'footer', $footer);

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
