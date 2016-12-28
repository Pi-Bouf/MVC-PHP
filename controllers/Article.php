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

	/**
	* Procédure de partage de l'article
	*/
	public function share()
	{
		if(count($_POST))
		{
			$id = $_GET['id'];
			// Si l'utilisateur est connecté, c'est son nom qui le partage'
			if(isset($_SESSION['user_logged']))
			{
				$user = new UserModel($_SESSION['user_logged']);
				$username = $user->name;
			} 
			// Sinon c'est "un ami"
			else {
				$username = 'un ami';
			}
			
			$article = new ArticleModel($id);
			$message = '<center><h1>Hey, viens lire ça ! :O</h1></center><br><br>';
			$message .= '<div style="font-family: \'Tahoma\', sans-serif; font-size: 20px; color: #8A4F62; text-align: center;">';
			$message .= 'Salut l\'ami, c\'est <i><b>'.$username.'</b></i> ! Regarde cet article, il va t\'intéresser !';
			$message .= '<div style="display: block; font-size: 15px; border: 1px solid grey; border-radius: 4px; padding: 20px; margin: 20px;">';
			$message .= $article->contenu;
			$message .= '</div>';
			$message .= '<a style="display: block; margin: 40px; border-radius: 5px; color: white; background-color: #9BC3D2; padding: 10px; text-decoration: none; font-weight: bold; font-size: 15px;" href="'.URLROOT.'article/detail?id='.$article->id.'">Lire plus »</a></div>';
			// Envoi du mail
			UserModel::sendMail($_POST['share'], 'MonSite - Viens lire ce que t\'envoie '.$username.'!', $message);
		}
		header('Location:'.WEBROOT.'article/detail?id='.$id);
	}
}