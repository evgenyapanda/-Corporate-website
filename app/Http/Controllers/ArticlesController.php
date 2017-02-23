<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

use Corp\Http\Requests;

use Corp\Category;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\CommentsRepository;
use Corp\Repositories\CategoriesRepository;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep, ArticlesRepository $a_rep, CommentsRepository $c_rep, CategoriesRepository $cat_rep )
    {

        parent::__construct(new \Corp\Repositories\MenusRepository((new \Corp\Menu)));

        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;

        $this->cat_rep = $cat_rep;

        $this->bar = 'right';
        $this->template = env('THEME').'.articles';
    }

    public function index($cat_alias = false)
    {
        //

        $this->title = 'Blog';
        $this->keywords = 'Info';
        $this->meta_desc= 'Desc';

        $articles = $this->getArticles($cat_alias);

        $content = view(env('THEME').'.articles_content')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));

        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments' => $comments, 'portfolios' => $portfolios]);

        return $this->renderOutput();
    }

    public function getComments($take){
        $comments = $this->c_rep->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $take);

        if($comments){
            $comments->load('article', 'user');
        }
        return $comments;

    }

    public function getPortfolios($take){
        $portfolios = $this->p_rep->get(['title', 'text', 'alias','customer', 'img', 'img_min', 'img_medium', 'img_max', 'filter_alias'], $take);
        return $portfolios;
    }

    /**
     * @param bool $alias
     * @return mixed
     */
    public function getArticles($alias = false)
    {
        $where = false;
        if($alias){

            //$id = $this->cat_rep->get('id')->where('alias', $alias);  //
       
            $id = Category::select('id')->where('alias', $alias)->get()->first()->id;
            $where = ['category_id', $id];
        }

        $articles = $this->a_rep->get('*', false, true, $where);

        if($articles){
           $articles->load('user', 'category', 'comments');
        }

        return $articles;
    }

    public function show($alias = false){

        $article = $this->a_rep->one($alias, ['comments' => true]);


        $this->title = $article->title;
        $this->keywords = $article->keywords;
        $this->meta_desc = $article->meta_desc;


       // dd($article->comments->groupBy('parent_id'));
        $content = view(env('THEME').'.article_content')->with('article', $article)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));

        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments' => $comments, 'portfolios' => $portfolios]);

        return $this->renderOutput();
    }
}
