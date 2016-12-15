<?php

class CommentaireController extends Controller{
	/** @todo créer une méthode "postprocess" qui permet à un utilisateur conneté de poster un commentaire, si l'utilisateur n'est pas connecté, afficher le formulaire de connexion */
	public function postprocess()
	{
		$idArticle = $_GET['idArticle'];
		if(count($_POST))
		{
			$commentaire = new CommentaireModel();
			$commentaire->titre = $_POST['titre'];
			$commentaire->contenu = $_POST['contenu'];
			$commentaire->datetime = date("Y-m-d H:i:s");
			$commentaire->id_user = 1;
			$commentaire->id_article = $idArticle;
			$commentaire->save();
			header('Location: ' . WEBROOT . 'article/detail?id=' + $idArticle);
		}
	}
}