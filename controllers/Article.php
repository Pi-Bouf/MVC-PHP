<?php

class ArticleController extends Controller{

	/**
	* Procédure affichant le détail d'un article
	* Renvoie article + commentaires associés
	*/
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