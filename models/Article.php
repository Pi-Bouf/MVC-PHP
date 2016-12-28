<?php

Class ArticleModel extends Model{
    public $id;
    public $titre;
    public $contenu;
    public $id_user;
    public $datetime;
    public $realDatetime;
    public $nbCommentaire;
    
    /**
    * @param int $id Identifiant de l'article
    * Constructeur de la classe ArticleModel
    */
    public function __construct($id=null) {
        parent::__construct();
        if(!is_null($id)){
            $data = $this->select($id);
            $this->id = $data['id'];
            $this->titre = $data['titre'];
            $this->contenu = $data['contenu'];
            $this->id_user = $data['id_user'];
            $this->realDatetime = $data['datetime'];
            $tmpDate = DateTime::createFromFormat('Y-m-d H:i:s', $data['datetime']);
            $tmpDate = $tmpDate !== false ? $tmpDate->format('d/m/Y à H:i:s') : $data['datetime'];
            $this->datetime = $tmpDate;
            $this->nbCommentaire = $data['nbCommentaire'];
        }
    }
    
    /**
    *  Insère dans MySQL un article
    */
    public function create(){
        $req = $this->bdd->prepare('INSERT INTO article (titre, contenu, id_user, datetime)'
        . ' VALUES(:titre, :contenu, :id_user, NOW())');
        $req->bindValue('titre', $this->titre, PDO::PARAM_STR);
        $req->bindValue('contenu', $this->contenu, PDO::PARAM_STR);
        $req->bindValue('id_user', $this->id_user, PDO::PARAM_INT);
        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }

    /**
    * @param int $id Identifiant de l'article
    * @return array Tableau (d'une ligne) contenant l'article demandé
    */
    public function select($id){
        $req = $this->bdd->prepare('SELECT article.*, Count(commentaire.id) as nbCommentaire FROM article LEFT JOIN commentaire ON article.id = commentaire.id_article WHERE article.id = :id');
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch();
    }

    /**
    * Mise à jour des informations
    */
    public function update(){
        $req = $this->bdd->prepare('UPDATE article SET titre=:titre, contenu=:contenu, '
        . 'id_user = :id_user WHERE id = :id');
        $req->bindValue('id', $this->id, PDO::PARAM_INT);
        $req->bindValue('titre', $this->titre, PDO::PARAM_STR);
        $req->bindValue('contenu', $this->contenu, PDO::PARAM_STR);
        $req->bindValue('id_user', $this->id_user, PDO::PARAM_INT);
        $req->execute();
    }

    /**
    * Suppression de l'article dans MySQL
    */
    public function delete(){
        CommentaireModel::deleteByArticle($this->id);
        $req = $this->bdd->prepare('DELETE FROM article WHERE id = :id');
        $req->bindValue('id', $this->id, PDO::PARAM_INT);
        $req->execute();
        // Si l'article a une image, on la supprime
        if(file_exists(ROOT.'upload/article/'.$this->id.'.jpg')) {
            unlink(ROOT.'upload/article/'.$this->id.'.jpg');
        }
    }
    
    /**
    * Procédure créant si l'article n'existe pas ou le met à jour
    */
    public function save(){
        if($this->id){
            $this->update();
        }else{
            $this->create();
        }
    }

    /**
    * @param $user_id Int = null Si aucun, renvoi tout les articles de la base, sinon ceux de l'utilisateur
    * @return array Tableau d'Article
    */ 
    public static function getAll($user_id = null){
        $model = self::getInstance();
        if(!is_null($user_id))
        $req = $model->bdd->prepare('SELECT id FROM article WHERE id_user = '.$user_id);
        else
            $req = $model->bdd->prepare('SELECT id FROM article ORDER BY datetime DESC');
        
        $req->execute();
        $articles = array();
        while($row = $req->fetch()){
            $article = new ArticleModel($row['id']);
            $articles[] = $article;
        }
        return $articles;
    }
    
    /**
    * @param nbr Int Nombre d'article à afficher
    * @param offset Int Offset représentant la page
    * @return array Tableau d'articles
    * Fonction qui a pour but de renvoyer des articles par page
    */
    public static function getAllOffset($nbr, $offset){
        $model = self::getInstance();
		$req = $model->bdd->prepare('SELECT article.id FROM article INNER JOIN user ON article.id_user = user.id  ORDER BY article.datetime DESC LIMIT '.($nbr * $offset).','.$nbr.'');
        $req->execute();
        $articles = array();
        while($row = $req->fetch()){
            $article = new ArticleModel($row['id']);
            $articles[] = $article;
        }
        return $articles;
    }

    /**
    * @param nbr Int Identifiant des utilisateurs
    * @return array Tableau d'articles
    * Fonction qui a pour but de renvoyer des articles qui ont été commentés par un utilisateur
    */
    public static function getAllByCommentUserId($id) {
        $model = self::getInstance();
        $req = $model->bdd->prepare('SELECT DISTINCT article.id FROM article INNER JOIN commentaire on article.id = commentaire.id_article WHERE commentaire.id_user = :id ORDER BY article.datetime DESC');
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();
        $articles = array();
        while($row = $req->fetch()){
            $article = new ArticleModel($row['id']);
            $articles[] = $article;
        }
        return $articles;
    }

    /**
    * @return Int Nombre d'articles dans la base
    */
    public static function getNbrTotal() {
        $model = self::getInstance();
		$req = $model->bdd->prepare('SELECT id FROM article');
        $req->execute();
        return $req->rowCount();
    }

    /**
    * param name String Date de la sauvegarde
    * Procédure créant une sauvegarde sous format CSV
    */
    public static function export($name)
    {
        $csvFile = fopen(ROOT.'upload/backupCSV/'.$name.'_ARTICLE.csv', 'a');
        $articles = ArticleModel::getAll();
        foreach($articles as $article) {
            fputcsv($csvFile, array($article->id, $article->titre, $article->contenu, $article->realDatetime, $article->id_user, $article->nbCommentaire));
        }
        fclose($csvFile);
    }
}