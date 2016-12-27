<?php

class ArticleController extends Controller{
	public function detail()
	{
		$id = $_GET['id'];
		$article = new ArticleModel($id);
		$this->set(array('article'=>$article));
		$this->render('detail');
	}
}