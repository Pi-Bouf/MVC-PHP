<?php

/** @todo sécuriser l'administration avec une connexion user */
class AdminArticleController extends Controller{

	public function index(){
		UserModel::isAdmin();
		$articles = ArticleModel::getAll();
		$this->set(array('articles'=>$articles));
		$this->render('index');
	}

	public function createedit(){
		UserModel::isAdmin();
		//si on a un id en GET, on charge l'article, sinon on charge un article vide pour la création
		$id = isset($_GET['id'])?$_GET['id']:null;
		$article = new ArticleModel($id);

		$this->set(array('article'=>$article));
		$this->render('createedit');
	}

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
		}
		header('Location: ' . WEBROOT . 'adminarticle/index');
	}

	public function delete(){
		UserModel::isAdmin();
		$article = new ArticleModel($_GET['id']);
		$article->delete();
		header('Location: ' . WEBROOT . 'adminarticle/index');
	}
}