<?php
/** @todo sécuriser l'administration avec une connexion user */
class AdminAccueilController extends Controller{

	/**
	* Procédure affichant l'index de l'accueil administrateur
	* N'affiche rien d'autre qu'un menu de départ
	*/
	public function index(){
		UserModel::isAdmin();
		$this->render('index');
	}
}