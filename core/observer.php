<?php

class commentObserverMail implements SplObserver {

    /**
    * @param obj SplSubject Objet contenant la classe observé
    * Procédure de mise à jour de l'observeur appelé lors du "notify"
    */
    public function update(SplSubject $obj)
    {
        // On récupère les données utiles
        $article = new ArticleModel($obj->id_article);
        $user = new UserModel($article->id_user);
        $user_comment = new UserModel($obj->id_user);
        // On crée le message
        $message = '<center><h1>Nouveau commentaire !</h1></center><br><br>';
        $message .= '<div style="font-family: \'Tahoma\', sans-serif; font-size: 20px; color: #8A4F62; text-align: center;">';
        $message .= 'Un commentaire à été ajouté à votre article: <i><b>'.$article->titre.'</b></i>';
        $message .= '<div style="display: block; font-size: 15px; border: 1px solid grey; border-radius: 4px; padding: 20px; margin: 20px;">';
        $message .= '<b>'.$obj->titre.'</b><br><br>'.$obj->contenu.'<br><br>Par <i>'.$user_comment->name.'</i>';
        $message .= '</div>';
        $message .= '<a style="display: block; margin: 40px; border-radius: 5px; color: white; background-color: #9BC3D2; padding: 10px; text-decoration: none; font-weight: bold; font-size: 15px;" href="'.URLROOT.'article/detail?id='.$article->id.'">Lire plus »</a></div>';
        // On envoi le mail à l'utilisateur concerné
        UserModel::sendMail($user->email, 'MonSite - '.$user->name.', nouveau commentaire sur votre article !', $message);
    }
}

?>