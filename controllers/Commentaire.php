<?php

class CommentaireController extends Controller{
	
	/**
	* Procédure appellé lors de la validation d'un formulaire
	* Elle crée le commentaire
	*/
	public function postprocess()
	{
		UserModel::isActif();
		$idArticle = $_GET['idArticle'];
		if(count($_POST))
		{
			$commentaire = new CommentaireModel();
			$commentaire->titre = $_POST['titre'];
			$commentaire->contenu = $_POST['contenu'];
			$commentaire->datetime = date("Y-m-d H:i:s");
			$user = new UserModel($_SESSION['user_logged']);
			$commentaire->id_user = $user->id;
			$commentaire->id_article = $idArticle;
			$commentaire->save();
		}
		header('Location:'.WEBROOT.'article/detail?id='.$idArticle);
	}
}
?>