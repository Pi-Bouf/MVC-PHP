<?php

class UserModel extends Model{
    public $id;
    public $name;
    public $email;
    public $password;
    public $actif;
    public $admin;
    public $nbArticle;
    public $nbCommentaire;

    /**
    * @param int $id Identifiant de l'utilisateur
    */
    public function __construct($id=null) {
		parent::__construct();
        if(!is_null($id)){
            //on récupère en base
            $data = $this->select($id);
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->password = $data['password'];
            $this->actif = $data['actif'];
            $this->admin = $data['admin'];
            $this->nbArticle = $data['nbArticle'];
            $this->nbCommentaire = $data['nbCommentaire'];
        }
    }

    /**
    *  Insère dans MySQL un utilisateur
    */
    public function create(){
        $req = $this->bdd->prepare('INSERT INTO user (name, email, password, actif, admin)'
                . ' VALUES(:name, :email, :password, :actif, :admin)');
        $req->bindValue('name', $this->name, PDO::PARAM_STR);
        $req->bindValue('email', $this->email, PDO::PARAM_STR);
        $req->bindValue('password', $this->password, PDO::PARAM_STR);
        $req->bindValue('actif', $this->actif, PDO::PARAM_BOOL);
        $req->bindValue('admin', $this->admin, PDO::PARAM_BOOL);
        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }

    /**
    * @param int $id Identifiant de l'utilisateur
    * @return array Tableau (d'une ligne) contenant l'utilisateur demandé
    */
    public function select($id){
        $req = $this->bdd->prepare('SELECT *, (SELECT count(*) FROM article WHERE article.id_user = :id) as nbArticle, (SELECT count(*) FROM commentaire WHERE commentaire.id_user = :id) as nbCommentaire FROM user WHERE id = :id');
        $req->bindValue('id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch();
    }

    /**
    * Mise à jour des informations
    */
    public function update(){
        $req = $this->bdd->prepare('UPDATE user SET name=:name, email=:email, '
                . 'password = :password, actif = :actif, admin = :admin WHERE id = :id');
        $req->bindValue('id', $this->id, PDO::PARAM_INT);
        $req->bindValue('name', $this->name, PDO::PARAM_STR);
        $req->bindValue('email', $this->email, PDO::PARAM_STR);
        $req->bindValue('password', $this->password, PDO::PARAM_STR);
        $req->bindValue('actif', $this->actif, PDO::PARAM_BOOL);
        $req->bindValue('admin', $this->admin, PDO::PARAM_BOOL);
        $req->execute();
    }

    /**
    * Suppression de l'utilisateur dans MySQL
    */
    public function delete(){
		//on supprime les commentaires
		CommentaireModel::deleteByUser($this->id);
		//on récuère ses articles
		$articles = ArticleModel::getAll($this->id);
		foreach($articles as $article){
			//pour chaque article, on supprime les commentaire
			//puis les articles
			$article->delete();
		}
		//on supprime enfin le user
        $req = $this->bdd->prepare('DELETE FROM user WHERE id = :id');
        $req->bindValue('id', $this->id, PDO::PARAM_INT);
        $req->execute();
        if(file_exists(ROOT.'upload/users/avatar_'.$this->id.'_800.jpg')) {
            unlink(ROOT.'upload/users/avatar_'.$this->id.'_800.jpg');
            unlink(ROOT.'upload/users/avatar_'.$this->id.'_500.jpg');
            unlink(ROOT.'upload/users/avatar_'.$this->id.'_150.jpg');
        }
    }

    /**
    * Procédure créant si l'utilisateur n'existe pas ou le met à jour
    */
    public function save(){
        if($this->id){
            $this->update();
        }else{
            $this->create();
        }
    }

    /**
    * @param actif Bool Booleen pour retourner les utilisateurs actifs ou inactifs
    * @return array Tableau d'Article ne comprenant que les actif
    * Renvoi liste d'utilisateur si actif ou non
    */
    public static function getAll($actif=null){
		$model = self::getInstance();
        
        if(!is_null($actif))
            $req = $model->bdd->prepare('SELECT id FROM user WHERE actif = TRUE');
        else
            $req = $model->bdd->prepare('SELECT id FROM user');
        $req->execute();
        $users = array();
        while($row = $req->fetch()){
            $user = new UserModel($row['id']);
            $users[] = $user;
        }
        return $users;
    }

    /**
    * @param login String Identifiant
    * @param pass String Mot de passe
    * @return bool S'il a reussi à se connecter ou passthru
    * Procédure de connexion, inscrivant une session si le login & pass sont reconnu
    */
    public static function userConnect($login, $pass) {
        $model = self::getInstance();

        $req = $model->bdd->prepare('SELECT id FROM user WHERE name = :name AND password = :password');
        $req->bindValue('name', $login, PDO::PARAM_STR);
        $req->bindValue('password', $pass, PDO::PARAM_STR);
        $req->execute();
        if($req->rowCount() == 1) {
            $data = $req->fetch();
            // Stockage dans la session
            $_SESSION['user_logged'] = $data['id'];
            return true;
        } else {
            return false;
        }
    }

    /**
    * Procédure vérifiant si l'utilisateur est actif ET administrateur
    * Blocage de l'execution du script via "exit()" pour empêcher les dérives post-scripts
    */
    public static function isAdmin() {
        if(isset($_SESSION['user_logged'])) {
            $user = new UserModel($_SESSION['user_logged']);
            if(!($user->actif == 1 && $user->admin == 1)) {
                header("Location:".WEBROOT."user/login");
                exit();
            }
        } else {
            header("Location:".WEBROOT."user/login");
            exit();
        }
    }

    /**
    * Procédure vérifiant si l'utilisateur est actif
    * Blocage de l'execution du script via "exit()" pour empêcher les dérives post-scripts
    */
    public static function isActif() {
        if(isset($_SESSION['user_logged'])) {
            $user = new UserModel($_SESSION['user_logged']);
            if($user->actif != 1) {
                header("Location:".WEBROOT."user/login");
                exit();
            }
        } else {
            header("Location:".WEBROOT."user/login");
            exit();
        }
    }

    /**
    * Procédure vidant la session pour permettre la déconnexion
    */
    public static function userDisconnect() {
        session_unset();
        session_destroy();
    }

    /**
    * param source String Source de la photo à réduire
    * param destination String Destination de la photo à créer
    * param sizeDest String Taille de l'image final (carré)
    */
    public static function cropAvatar($source, $destination, $sizeDest) {
        // Selon le format de l'image, on la charge d'une manière spécifique
        switch(substr($source, strlen($source) - 3, 3)) {
            case 'jpg':
            case 'jpeg':
            {
                $image_original = imagecreatefromjpeg($source);
                break;
            }
            case 'png':
            {
                $image_original = imagecreatefrompng($source);
                break;
            }
            case 'gif':
            {
                $image_original = imagecreatefromgif($source);
                break;
            }
        }

        // On crée l'image qui va recevoir l'original
        $image_cropped = imagecreatetruecolor($sizeDest, $sizeDest);
        // Fond blanc (mieux que font noir pour la transparence)
        $white = imagecolorallocate($image_cropped, 255, 255, 255);
        imagefill($image_cropped, 0, 0, $white);
        // Si l'image est en paysage
        if(imagesx($image_original) >= imagesy($image_original)) {
            imagecopyresampled($image_cropped, $image_original, 0, 0, (imagesx($image_original) - imagesy($image_original)) / 2, 0, $sizeDest, $sizeDest, imagesy($image_original), imagesy($image_original));
        } 
        // Sinon en portrait
        else {
            imagecopyresampled($image_cropped, $image_original, 0, 0, 0, (imagesy($image_original) - imagesx($image_original)) / 2, $sizeDest, $sizeDest, imagesx($image_original), imagesx($image_original));
        }
        // On crée l'image forcément en JPG
        imagejpeg($image_cropped, $destination, 100);
    }

    /**
    * param name String Date de la sauvegarde
    * Procédure créant une sauvegarde sous format CSV
    */
    public static function export($name)
    {
        $csvFile = fopen(ROOT.'upload/backupCSV/'.$name.'_USER.csv', 'a');
        $users = UserModel::getAll();
        foreach($users as $user) {
            fputcsv($csvFile, array($user->id, $user->name, $user->email, $user->password, $user->actif, $user->admin, $user->nbArticle, $user->nbCommentaire));
        }
        fclose($csvFile);
    }

    /**
    * @param id_user Int Identifiant de l'utilisateur
    * @param subject String Sujet du message
    * @param message String Contenu de message
    * Procédure qui enverra un mail à l'utilisateur désigné
    */
    public static function sendMail($mail_user, $subject, $message)
    {
        $headers ='From: "Pierre Bouffier"<pierre.bouffier05@gmail.com>'."\n"; 
        $headers .='Reply-To: "Pierre Bouffier"pierre.bouffier05@gmail.com'."\n"; 
        $headers .='Content-Type: text/html; charset="utf-8"'."\n"; 
        $headers .='Content-Transfer-Encoding: 8bit';
        mail($mail_user, $subject, $message, $headers);
    }
}
?>