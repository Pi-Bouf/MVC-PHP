<?php
/** @todo sécuriser l'administration avec une connexion user */
class AdminAccueilController extends Controller{

	public function index(){
		UserModel::isAdmin();
		$this->render('index');
	}
}