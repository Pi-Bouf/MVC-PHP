<div id="container">
    <?php
        echo '<div class="article">';
        echo '<div class="title">'.$article->titre.'</div>';
        if(file_exists(ROOT.'upload/article/'.$article->id.'.jpg')) {
            $img = WEBROOT.'upload/article/'.$article->id.'.jpg';
        } else {
            $img = WEBROOT.'upload/article/defaut.jpg';
        }
        echo '<div class="image"><img src="'.$img.'"></div>';
        echo '<div class="text">'.$article->contenu;
        echo '<a class="readmore" href="'.WEBROOT.'article/detail?id='.$article->id.'">Voir plus »</a>';
        echo '</div>';
        $user = new UserModel($article->id_user);
        if(file_exists(ROOT.'upload/users/avatar_'.$user->id.'_150.jpg')) {
            $img = WEBROOT.'upload/users/avatar_'.$user->id.'_150.jpg';
        } else {
            $img = WEBROOT.'upload/users/avatar_defaut_150.jpg';
        }
        echo '<div class="dateauteur">Par <b><a href="'.WEBROOT.'user/detail?id='.$user->id.'">'.$user->name.'</a></b> le <b>'.$article->datetime.'</b><br /><img style="float: right; border-radius: 8px;" src="'.$img.'"></div>';
        echo '<div style="clear: both"></div></div>';
        echo '<div class="separator"></div>';
    ?>

<h2>Commentaires <i>(<?php echo $article->nbCommentaire; ?>)</i></h2>
<?php
    foreach($commentaires as $commentaire) {
        echo '<div class="commentaire">';
        $user = new UserModel($commentaire->id_user);
        if(file_exists(ROOT.'upload/users/avatar_'.$user->id.'_150.jpg')) {
            $img = WEBROOT.'upload/users/avatar_'.$user->id.'_150.jpg';
        } else {
            $img = WEBROOT.'upload/users/avatar_defaut_150.jpg';
        }
        echo '<div class="avatar"><img src="'.$img.'">';
        echo '<div class="dateauteur"><center><a href="'.WEBROOT.'user/detail?id='.$user->id.'">'.$user->name.'</a><br />Posté le<br />'.$commentaire->datetime.'</center><br /><br /></div>';
        echo '</div>';
        echo '<div class="content">';
        echo '<div class="titre">'.$commentaire->titre.'</div>';
        echo '<div class="texte">'.$commentaire->contenu.'</div>';
        echo '</div>';
        echo '</div><div style="clear: both"></div>';
        echo '<div class="separator"></div>';
    }
?>
<form action="<?php echo WEBROOT.'commentaire/postprocess?idArticle='.$article->id ?>" method="post">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" required="required"/><br />
    <label for="contenu">Contenu :</label>
    <textarea name="contenu" id="contenu" name="contenu" required="required"></textarea><br /><br />
    <input type="submit" value="Envoyer !">
</form>
</div>