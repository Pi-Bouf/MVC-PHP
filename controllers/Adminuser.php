<?php
class AdminUserController extends Controller{

	/**
	* Procédure affichant l'index de l'administration des utilisateurs
	* Affichage de tout les utilisateurs
	*/
	public function index(){
		UserModel::isAdmin();
		$users = UserModel::getAll();
		$this->set(array('users'=>$users));
		$this->render('index');
	}

	/**
	* Procédure affichant la page de création OU modification d'un utilisateur
	* S'il y a un ID par GET, alors modif. Sinon, création
	*/
	public function createedit(){
		UserModel::isAdmin();
		$id = isset($_GET['id'])?$_GET['id']:null;
		$user = new UserModel($id);
		$this->set(array('user'=>$user));
		$this->render('createedit');
	}

	/**
	* Procédure appellé lors de la validation d'un formulaire
	* Elle crée ou modifie l'utilisateur
	*/
	public function postprocess(){
		UserModel::isAdmin();
		if(count($_POST)){
			$id = isset($_GET['id'])?$_GET['id']:null;
			$user = new UserModel($id);
			$user->name = $_POST['name'];
			$user->email = $_POST['email'];
			//on met à jour le mot de passe uniquement s'il change
			if($_POST['password']!='')
				$user->password = hash('sha256', $_POST['password']);
			$user->actif = $_POST['actif'];
			$user->admin = $_POST['admin'];
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
		header('Location: ' . WEBROOT . 'adminuser/index');
	}

	/**
	* Procédure appellé lors de la suppression de l'utilisateur
	* Supprime l'utilisateur et revient sur l'index
	*/
	public function delete(){
		UserModel::isAdmin();
		$user = new UserModel($_GET['id']);
		$user->delete();
		header('Location: ' . WEBROOT . 'adminuser/index');
	}
}