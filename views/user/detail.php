<div id="container">
    <?php
        echo '<div class="list">';
        echo '<div class="titre">'.$user->name.'</div>';

        if(file_exists(ROOT.'upload/users/avatar_'.$user->id.'_500.jpg')) {
            $img = WEBROOT.'upload/users/avatar_'.$user->id.'_500.jpg';
        } else {
            $img = WEBROOT.'upload/users/avatar_defaut_500.jpg';
        }
        echo '<center><img src="'.$img.'"></center>';
        echo '<br /><i>'.$user->email.'</i><br /><br />';
        echo '</div>';
    ?>

    <h2>Mes articles créés</h2>
    <?php
    foreach($articles as $article) {
        echo '<div class="listArticle">';
        if(file_exists(ROOT.'upload/article/'.$article->id.'.jpg')) {
            $img = WEBROOT.'upload/article/'.$article->id.'.jpg';
        } else {
            $img = WEBROOT.'upload/article/defaut.jpg';
        }
        echo '<img src="'.$img.'">';
        echo '<div class="titre"><a href="'.WEBROOT.'article/detail?id='.$article->id.'">'.$article->titre.'</a></div>';
        echo $article->datetime.' - '.$article->nbCommentaire.' commentaires';
        echo '<div style="clear: both"></div></div><div class="separator"></div>';
    }
    ?>

    <h2>Mes articles commentés</h2>
    <?php
    foreach($artcommented as $article) {
        echo $article->datetime.' - <a href="'.WEBROOT.'article/detail?id='.$article->id.'">'.$article->titre.'</a><br>';
    }
    ?>
</div>