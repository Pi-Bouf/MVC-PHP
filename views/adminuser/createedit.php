<div id="container">
	<h2>Edition/création d'utilisateurs</h2>
	<div id="menuAdmin">
	    <?php
            // On parcourt le tableau menu pour l'afficher
            foreach($menuAdmin as $key => $value) {
                echo '<a href="'.WEBROOT.$key.'">'.$value.'</a> ';
            }
        ?>
	</div>
	
	<form enctype="multipart/form-data" action="<?php echo WEBROOT.'adminuser/postprocess?id='.$user->id ?>" method="post">
		<label for="name">Name :</label><input type="text" id="name" name="name" value="<?php echo $user->name ?>" required="required"/><br />
		<label for="email">Email :</label><input type="text" id="email" name="email" value="<?php echo $user->email ?>" required="required"/><br />
		<label for="password">Mot de passe :</label><input type="password" id="password" name="password" value="" <?php echo (empty($_GET['id']))?'required="required"':'' ?>/><br />
		<label for="actif">Actif :</label>
		<input type="radio" id="actif" name="actif" value="1" <?php echo ($user->actif)?'checked':'' ?> /><label for="actif" class="radio">Oui</label>
		<input type="radio" id="actif_non" name="actif" value="0" <?php echo ($user->actif)?'':'checked' ?> /><label for="actif_non" class="radio">Non</label>
		<br />
		<label for="admin">Admin :</label>
		<input type="radio" id="admin" name="admin" value="1" <?php echo ($user->admin)?'checked':'' ?> /><label for="admin" class="radio">Oui</label>
		<input type="radio" id="admin_non" name="admin" value="0" <?php echo ($user->admin)?'':'checked' ?> /><label for="admin_non" class="radio">Non</label>
		<br /><br />
		<label for="avatar">Avatar: </label>
		<input type="file" name="avatarImage" id="avatar">
		<input type="submit" value="Enregistrer" />
	</form>
</div>