<?php

class Model implements SplSubject{
	//Instance de la classe PDO
	public $bdd = null;

	//Instance de la classe Model
	private static $instance = null;

	//Constante: nom d'utilisateur de la bdd
	const DEFAULT_SQL_USER = DB_USER;

	//Constante: hôte de la bdd
	const DEFAULT_SQL_HOST = DB_HOST;

	//Constante: hôte de la bdd
	const DEFAULT_SQL_PASS = DB_PASS;

	//Constante: nom de la bdd
	const DEFAULT_SQL_DTB = DB_DATABASE;

	public function __construct(){
		if(is_null(self::$instance)){
			if(DEBUG)
			{
				$this->bdd = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST
				,self::DEFAULT_SQL_USER,self::DEFAULT_SQL_PASS
				, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				self::$instance = $this;
			} else {
					$this->bdd = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST
					,self::DEFAULT_SQL_USER,self::DEFAULT_SQL_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			}
		}else{
			$inst = self::getInstance();
			$this->bdd = $inst->bdd;
		}
	}

	//Crée et retourne l'objet Model
	public static function getInstance(){
		if(is_null(self::$instance)){
			self::$instance = new Model();
		}
		return self::$instance;
	}

	public function attach(SplObserver $observer){
            $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer){
        if (is_int($key = array_search($observer, $this->observers, true))){
            unset($this->observers[$key]);
        }
    }
    public function notify(){
        foreach ($this->observers as $observer){
            $observer->update($this);
        }
    }
}