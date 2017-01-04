<div id="container">
    <h2>Mon profil</h2>

	<form enctype="multipart/form-data" action="<?php echo WEBROOT.'user/postprocess?id='.$user->id ?>" method="post">
		<label for="name">Name :</label><input type="text" id="name" name="name" value="<?php echo $user->name ?>" required="required"/><br />
		<label for="email">Email :</label><input type="text" id="email" name="email" value="<?php echo $user->email ?>" required="required"/><br />
		<label for="password">Mot de passe :</label><input type="password" id="password" name="password" placeholder="Laissez vide pour garder le même MDP"/><br />
		<?php
        if(file_exists(ROOT.'upload/users/avatar_'.$user->id.'_500.jpg')) {
            $img = WEBROOT.'upload/users/avatar_'.$user->id.'_500.jpg';
        } else {
            $img = WEBROOT.'upload/users/avatar_defaut_500.jpg';
        }
        echo '<br /><center><img src="'.$img.'"></center><br />';
    	?>
		<label for="avatar">Avatar: </label>
		<input type="file" name="avatarImage" id="avatar">
		<input type="submit" value="Enregistrer" />
	</form>
</div>