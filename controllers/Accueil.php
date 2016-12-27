<?php

class AccueilController extends Controller{

	public function index(){
		$page = isset($_GET['page'])?$_GET['page']:0;
		$articles = ArticleModel::getAllOffset(10, $page);
		$this->set(array('articles'=>$articles));
		$this->set(array('nbrTotal'=>ArticleModel::getNbrTotal()));
		$this->render('index');
	}
}