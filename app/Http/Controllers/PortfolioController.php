<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\PortfoliosRepository;

class PortfolioController extends SiteController
{
    //
    public function __construct(PortfoliosRepository $p_rep)
    {

        parent::__construct(new \Corp\Repositories\MenusRepository((new \Corp\Menu)));

        $this->p_rep = $p_rep;

        $this->template = env('THEME') . '.portfolios';
    }


    public function index()
    {
        //

        $this->title = 'Портфолио';
        $this->keywords = 'Портфолио';
        $this->meta_desc = 'Портфолио';

        $portfolios = $this->getPortfolios();

        $content = view(env('THEME').'.portfolios_content')->with('portfolios', $portfolios)->render();
        $this->vars = array_add($this->vars, 'content', $content);


        return $this->renderOutput();
    }

    public function getPortfolios(){
        $portfolios = $this->p_rep->get('*', false, true);
        if($portfolios){
            $portfolios->load('filter');
        }

        return $portfolios;
    }
}