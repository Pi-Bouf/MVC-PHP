<?php
class ConnexionController extends Controller {


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

}
?>