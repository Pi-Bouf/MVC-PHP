<?php
//ALTER TABLE `user` ADD `admin` BOOLEAN NOT NULL DEFAULT FALSE AFTER `actif`;
/** @todo sécuriser l'administration avec une connexion user */
class AdminUserController extends Controller{

	public function index(){
		$users = UserModel::getAll();
		$this->set(array('users'=>$users));
		$this->render('index');
	}

	public function createedit(){
		$id = isset($_GET['id'])?$_GET['id']:null;
		$user = new UserModel($id);
		$this->set(array('user'=>$user));
		$this->render('createedit');
	}

	public function postprocess(){
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
		}
		header('Location: ' . WEBROOT . 'adminuser/index');
	}

	public function delete(){
		$article = new UserModel($_GET['id']);
		$article->delete();
		header('Location: ' . WEBROOT . 'adminuser/index');
	}
}