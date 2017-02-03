<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

use Corp\Http\Requests;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\CommentsRepository;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep, ArticlesRepository $a_rep, CommentsRepository $c_rep)
    {

        parent::__construct(new \Corp\Repositories\MenusRepository((new \Corp\Menu)));

        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;

        $this->bar = 'right';
        $this->template = env('THEME').'.articles';
    }

    public function index()
    {
        //
        $articles = $this->getArticles();

        $content = view(env('THEME').'.articles_content')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments' => $comments, 'portfolios' => $portfolios]);

        return $this->renderOutput();
    }

    public function getComments($take){
        $comments = $this->c_rep->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $take);
        return $comments;

    }

    public function getPortfolios($take){
        $portfolios = $this->p_rep->get(['title', 'text', 'alias','customer', 'img', 'img_min', 'img_medium', 'img_max', 'filter_alias'], $take);
        return $portfolios;
    }

    public function getArticles($alias = false)
    {
        $articles = $this->a_rep->get('*', false, true);

        if($articles){
           // $articles->load('user', 'category', 'comments');
        }

        return $articles;
    }
}
