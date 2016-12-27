<?php

class ArticleController extends Controller{
	public function listArticle()
	{
		$articles = ArticleModel::getAllOffset(5, 0);
		$this->set(array('articles' => $articles));
		$this->render('listArticle');
	}
	
	public function detail()
	{
		$id = $_GET['id'];
		$article = new ArticleModel($id);
		$this->set(array('article'=>$article));
		$this->render('detail');
	}
}