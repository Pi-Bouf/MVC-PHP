<?php

class UserController extends Controller{
	/** @todo Créer une méthode pour que l'utilisateur puisse se connecter */
	public function login() {
		if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password'])) {
			if(UserModel::userConnect($_POST['login'], hash('sha256', $_POST['password']))) {
				header("Location: ".WEBROOT."accueil/index");
			} else {
				$this->set(array("errorLogin" => "Nom ou utilisateur non reconnu !"));
			}
		}
		$this->render('login');
	}

	public function logout() {
        UserModel::userDisconnect();
        $this->render('logout');
    }

	/** @todo Créer une méthode pour que l'utilisateur puisse modifier son profil (sauf les champs actif et admin) */
	public function myprofile() {
		UserModel::isActif();
		$user = new UserModel($_SESSION['user_logged']);
		$this->set(array("user" => $user));
		$this->render("myprofile");
	}

	public function postprocess() {
		UserModel::isActif();
		if(count($_POST))
		{
			$id = $_GET['id'];
			$user = new UserModel($id);
			$user->name = $_POST['name'];
			$user->email = $_POST['email'];
			//on met à jour le mot de passe uniquement s'il change
			if($_POST['password']!='')
				$user->password = hash('sha256', $_POST['password']);
			$user->save();
			if(!empty($_FILES['avatarImage']['tmp_name'])) {
				if(move_uploaded_file($_FILES['avatarImage']['tmp_name'], ROOT.'upload/tmp/'.$_FILES['avatarImage']['name'])) {
					cropImg(ROOT.'upload/tmp/'.$_FILES['avatarImage']['name'], ROOT.'upload/users/avatar_'.$user->id.'_800.jpg', 800, 800);
					cropImg(ROOT.'upload/tmp/'.$_FILES['avatarImage']['name'], ROOT.'upload/users/avatar_'.$user->id.'_500.jpg', 500, 800);
					cropImg(ROOT.'upload/tmp/'.$_FILES['avatarImage']['name'], ROOT.'upload/users/avatar_'.$user->id.'_150.jpg', 150, 800);
					unlink(ROOT.'upload/tmp/'.$_FILES['avatarImage']['name']);
				}
			}
		}
		header('Location:'.WEBROOT.'user/myprofile');
	}

	public function listuser()
	{
		$users = UserModel::getAll();
		$this->set(array("users" => $users));
		$this->render("listuser");
	}

	public function detail()
	{
		$id = $_GET['id'];
		$user = new UserModel($id);
		$articlesById = ArticleModel::getAllByUserId($id);
		$articlesByCommentId = ArticleModel::getAllByCommentUserId($id);
		$this->set(array('user' => $user, 'articles' => $articlesById, 'artcommented' => $articlesByCommentId));
		$this->render('detail');
	}
}
?>