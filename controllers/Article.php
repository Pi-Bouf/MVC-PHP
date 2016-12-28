<?php

class ArticleController extends Controller{
	public function detail()
	{
		$id = $_GET['id'];
		$article = new ArticleModel($id);
		$commentaires = CommentaireModel::getAllByArtId($id);
		$this->set(array('article'=>$article));
		$this->set(array('commentaires'=>$commentaires));
		$this->render('detail');
	}
}