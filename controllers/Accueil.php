<?php

class AccueilController extends Controller{

	public function index(){
		$articles = ArticleModel::getAllLimit(10);
		$this->set(array('articles'=>$articles));
		$this->render('index');
	}
}