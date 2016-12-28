<?php

/** @todo sécuriser l'administration avec une connexion user */
class AdminArticleController extends Controller{

	/**
	* Procédure affichant l'index de l'administration de articles
	* Affichage de tout les articles
	*/
	public function index(){
		UserModel::isAdmin();
		$articles = ArticleModel::getAll();
		$this->set(array('articles'=>$articles));
		$this->render('index');
	}

	/**
	* Procédure affichant la page de création OU modification d'un article
	* S'il y a un ID par GET, alors modif. Sinon, création
	*/
	public function createedit(){
		UserModel::isAdmin();
		//si on a un id en GET, on charge l'article, sinon on charge un article vide pour la création
		$id = isset($_GET['id'])?$_GET['id']:null;
		$article = new ArticleModel($id);

		$this->set(array('article'=>$article));
		$this->render('createedit');
	}

	/**
	* Procédure appellé lors de la validation d'un formulaire
	* Elle crée ou modifie l'article
	*/
	public function postprocess(){
		UserModel::isAdmin();
		//on vérifie si on a bien des donnee POST envoyée
		if(count($_POST)){
			$id = isset($_GET['id'])?$_GET['id']:null;
			$article = new ArticleModel($id);
			$article->titre = $_POST['titre'];
			$article->contenu = $_POST['contenu'];
			$user = new UserModel($_SESSION['user_logged']);
			$article->id_user = $user->id;
			$article->datetime = date('Y-m-d H:i:s');
			$article->save();
			// Si le champ d'image est rempli, alors on télécharge et on place dans le bon dossier
			// l'image de l'article sous le nom "ID.jpg" du dossier "upload/article/"
			if(!empty($_FILES['articleImage']['tmp_name'])) {
				move_uploaded_file($_FILES['articleImage']['tmp_name'], ROOT.'upload/article/'.$article->id.'.jpg');
			}
		}
		header('Location: ' . WEBROOT . 'adminarticle/index');
	}

	/**
	* Procédure appellé lors de la suppression de l'article
	* Supprime l'article et revient sur l'index
	*/
	public function delete(){
		UserModel::isAdmin();
		$article = new ArticleModel($_GET['id']);
		$article->delete();
		header('Location: ' . WEBROOT . 'adminarticle/index');
	}
}
?>