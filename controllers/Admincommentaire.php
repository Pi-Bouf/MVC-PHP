<?php

class AdminCommentaireController extends Controller{

	public function index() {
		UserModel::isAdmin();
		$commentaires = CommentaireModel::getAll();
		$this->set(array('commentaires'=>$commentaires));
		$this->render('index');
	}

	public function edit() {
		UserModel::isAdmin();
		// Si on a un id en GET, on charge le commentaire, sinon on sort
		if(isset($_GET['id'])) {
			$commentaire = new CommentaireModel($_GET['id']);
			$this->set(array('commentaire'=>$commentaire));
			$this->render('edit');
		} else {
			header('Location: ' . WEBROOT . 'admincommentaire/index');
		}
	}

	public function postprocess(){
		UserModel::isAdmin();
		//on vérifie si on a bien des donnee POST envoyée
		if(count($_POST)){
			if(isset($_GET['id'])) {
				$commentaire = new CommentaireModel($_GET['id']);
				$commentaire->titre = $_POST['titre'];
				$commentaire->contenu = $_POST['contenu'];
				$commentaire->save();
			}
		}
		header('Location: ' . WEBROOT . 'admincommentaire/index');
	}

	public function delete(){
		UserModel::isAdmin();
		$commentaire = new CommentaireModel($_GET['id']);
		$commentaire->delete();
		header('Location: ' . WEBROOT . 'admincommentaire/index');
	}
}