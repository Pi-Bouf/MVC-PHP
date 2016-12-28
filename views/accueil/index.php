<div id="container">
    <?php
    if($nbrTotal == 0) {
        echo '<h2>Il n\'y a aucun article pour le moment...</h2>';
    } else {
        foreach($articles as $key => $value) {
            echo '<div class="article">';
            echo '<div class="title">'.$value->titre.'</div>';
            if(file_exists(ROOT.'upload/article/'.$value->id.'.jpg')) {
                $img = WEBROOT.'upload/article/'.$value->id.'.jpg';
            } else {
                $img = WEBROOT.'upload/article/defaut.jpg';
            }
            echo '<div class="image"><img src="'.$img.'"></div>';
            echo '<div class="text">'.$value->contenu;
            echo '<a class="readmore" href="'.WEBROOT.'article/detail?id='.$value->id.'">Voir plus <i>('.$value->nbCommentaire.')</i> »</a>';
            echo '</div>';
            $user = new UserModel($value->id_user);
            echo '<div class="dateauteur">Par <b>'.$user->name.'</b> le <b>'.$value->datetime.'</b></div>';
            echo '<div style="clear: both"></div></div>';
            echo '<div class="separator"></div>';
        }
        echo "Page:<br><center>";
        $nbr = $nbrTotal / 10;
        for($i = 0; $i < $nbr; $i++) {
            echo '<a href="'.WEBROOT.'accueil/index?page='.$i.'">'.$i.'</a> ';
        }
        echo "</center>";
    }
    ?>

</div>