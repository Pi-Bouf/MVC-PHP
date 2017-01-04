<?php

class UserController extends Controller{
	
	/**
	* Procédure appellé lors de la validation d'un formulaire
	* Elle connecte l'utilisateur et renvoie sur l'accueil // ou sinon sur la page de connexion
	*/
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

	/**
	* Procédure appellé pour déconnecté l'utilisateur
	*/
	public function logout() {
        UserModel::userDisconnect();
        $this->render('logout');
    }

	/**
	* Procédure renvoyant les informations du compte actuellement connecté
	*/
	public function myprofil() {
		UserModel::isActif();
		$user = new UserModel($_SESSION['user_logged']);
		$this->set(array("user" => $user));
		$this->render("myprofil");
	}

	/**
	* Procédure appellé lors de la validation d'un formulaire
	* Elle modifie les informations du compte actuellement connecté
	*/
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
					UserModel::cropAvatar(ROOT.'upload/tmp/'.$_FILES['avatarImage']['name'], ROOT.'upload/users/avatar_'.$user->id.'_800.jpg', 800, 800);
					UserModel::cropAvatar(ROOT.'upload/tmp/'.$_FILES['avatarImage']['name'], ROOT.'upload/users/avatar_'.$user->id.'_500.jpg', 500, 800);
					UserModel::cropAvatar(ROOT.'upload/tmp/'.$_FILES['avatarImage']['name'], ROOT.'upload/users/avatar_'.$user->id.'_150.jpg', 150, 800);
					unlink(ROOT.'upload/tmp/'.$_FILES['avatarImage']['name']);
				}
			}
		}
		header('Location:'.WEBROOT.'user/myprofil');
	}

	/**
	* Procédure renvoyant la liste des utilisateurs
	*/
	public function listuser()
	{
		$users = UserModel::getAll();
		$this->set(array("users" => $users));
		$this->render("listuser");
	}

	/**
	* Procédure affichant le détail d'un utilisateur
	*/
	public function detail()
	{
		$id = $_GET['id'];
		$user = new UserModel($id);
		$articlesById = ArticleModel::getAll($id);
		$articlesByCommentId = ArticleModel::getAllByCommentUserId($id);
		$this->set(array('user' => $user, 'articles' => $articlesById, 'artcommented' => $articlesByCommentId));
		$this->render('detail');
	}
}
?>