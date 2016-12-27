<?php

class AccueilController extends Controller{

	public function index(){
		$articles = ArticleModel::getAllOffset(5, 0);
		$this->set(array('articles'=>$articles));
		$this->render('index');
	}
}