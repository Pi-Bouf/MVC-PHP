<?php

class CommentaireModel extends Model {
    public $id;
    public $titre;
    public $contenu;
    public $id_user;
    public $id_article;
    public $datetime;
    protected $observers = [];

    /**
    * @param int $id Identifiant du commentaire
    */
    public function __construct($id=null) {
		parent::__construct();
        if(!is_null($id)){
            //on récupère en base
            $data = $this->select($id);
            $this->id = $data['id'];
            $this->titre = $data['titre'];
            $this->contenu = $data['contenu'];
            $this->id_user = $data['id_user'];
            $this->id_article = $data['id_article'];
            $this->datetime = $data['datetime'];
        }
        $this->attach(new commentObserverMail);
    }

    /**
    *  Insère dans MySQL un commentaire
    */
    public function create(){        
        $req = $this->bdd->prepare('INSERT INTO commentaire (titre, contenu, id_user, id_article, datetime)'
                . ' VALUES(:titre, :contenu, :id_user, :id_article, NOW())');
        $req->bindValue('titre', $this->titre, PDO::PARAM_STR);
        $req->bindValue('contenu', $this->contenu, PDO::PARAM_STR);
        $req->bindValue('id_user', $this->id_user, PDO::PARAM_INT);
        $req->bindValue('id_article', $this->id_article, PDO::PARAM_INT);
        $req->execute();
        $this->id = $this->bdd->lastInsertId();
        // On notifie l'observeur
        $this->notify();
    }

    /**
    * @param int $id Identifiant du commentaire
    * @return array Tableau (d'une ligne) contenant le commentaire demandé
    */
    public function select($id){
        
        $req = $this->bdd->prepare('SELECT * FROM commentaire WHERE id = :id');
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch();
    }

    /**
    * Mise à jour des informations
    */
    public function update(){
        
        $req = $this->bdd->prepare('UPDATE commentaire SET titre=:titre, contenu=:contenu, '
                . 'id_user = :id_user, id_article = :id_article WHERE id = :id');
        $req->bindValue('id', $this->id, PDO::PARAM_INT);
        $req->bindValue('titre', $this->titre, PDO::PARAM_STR);
        $req->bindValue('contenu', $this->contenu, PDO::PARAM_STR);
        $req->bindValue('id_user', $this->id_user, PDO::PARAM_INT);
        $req->bindValue('id_article', $this->id_article, PDO::PARAM_INT);
        $req->execute();
    }

    /**
    * Suppression du commentaire dans MySQL
    */
    public function delete(){
        
        $req = $this->bdd->prepare('DELETE FROM commentaire WHERE id = :id');
        $req->bindValue('id', $this->id, PDO::PARAM_INT);
        $req->execute();
    }

    /**
    * Procédure créant si le commentaire n'existe pas ou le met à jour
    */
    public function save(){
        if($this->id){
            $this->update();
        }else{
            $this->create();
        }
    }

    /**
    * @return array Tableau de commentaires
    * Renvoi tout les commentaires de la base
    */
    public static function getAll(){
		$model = self::getInstance();
        $req = $model->bdd->prepare('SELECT id FROM commentaire');
        $req->execute();
        $commentaires = array();
        while($row = $req->fetch()){
            $commentaire = new CommentaireModel($row['id']);
            $commentaires[] = $commentaire;
        }
        return $commentaires;
    }

    /**
    * @param int $id Identifiant de l'article
    * @return array Tableau d'Article
    */
    public static function getAllByArtId($id){
        $model = self::getInstance();
        $req = $model->bdd->prepare('SELECT id FROM commentaire WHERE id_article = :id_article ORDER BY datetime DESC');
        $req->bindValue('id_article', $id, PDO::PARAM_INT);
        $req->execute();
        $commentaires = array();
        while($row = $req->fetch()){
            $commentaire = new CommentaireModel($row['id']);
            $commentaires[] = $commentaire;
        }
        return $commentaires;
    }

    /**
    * @param id_article Int Identifiant de l'article
    * Supprime les commentaires d'un article
    */
    public static function deleteByArticle($id_article){
		$model = self::getInstance();

        $reqCom = $model->bdd->prepare('DELETE FROM commentaire WHERE id_article = :id');
        $reqCom->bindValue('id', $id_article, PDO::PARAM_INT);
        $reqCom->execute();
    }

    /**
    * @param id_user Int Identifiant d'un utilisateur
    * Supprime les commentaires d'un utilisateur
    */
    public static function deleteByUser($id_user){
		$model = self::getInstance();

        $req = $model->bdd->prepare('DELETE FROM commentaire WHERE id_user = :id');
        $req->bindValue('id', $id_user, PDO::PARAM_INT);
        $req->execute();
    }

    /**
    * param name String Date de la sauvegarde
    * Procédure créant une sauvegarde sous format CSV
    */
    public static function export($name)
    {
        $csvFile = fopen(ROOT.'upload/backupCSV/'.$name.'_COMMENTAIRE.csv', 'a');
        $commentaires = CommentaireModel::getAll();
        foreach($commentaires as $commentaire) {
            fputcsv($csvFile, array($commentaire->id, $commentaire->titre, $commentaire->contenu, $commentaire->datetime, $commentaire->id_user, $commentaire->id_article));
        }
        fclose($csvFile);
    }
}
