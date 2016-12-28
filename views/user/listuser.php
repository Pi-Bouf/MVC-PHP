<div id="container">
    <h2>Liste des utilisateurs</h2>
    <?php
    foreach($users as $user) {
        echo '<div class="userList">';
        if(file_exists(ROOT.'upload/users/avatar_'.$user->id.'_150.jpg')) {
            $img = WEBROOT.'upload/users/avatar_'.$user->id.'_150.jpg';
        } else {
            $img = WEBROOT.'upload/users/avatar_defaut_150.jpg';
        }
        echo '<img src="'.$img.'">';
        echo '<div class="content">';
        echo '<div class="name">'.$user->name.'</div>';
        echo '<i>Email: </i><b>'.$user->email.'</b>';
        echo '<br /><i>Nombre d\'articles: </i><b>'.$user->nbArticle.'</b>';
        echo '<br /><i>Nombre de commentaires: </i><b>'.$user->nbCommentaire.'</b>';
        echo '<br /><br /><a href="'.WEBROOT.'user/detail?id='.$user->id.'">Voir le profil </a>';
        echo '</div>';
        echo '<div style="clear: both"></div></div>';
    }
    ?>
    </div>
</div>