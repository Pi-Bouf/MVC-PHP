<div id="container">
	<h2>Edition de commentaire</h2>
	<div id="menuAdmin">
	    <?php
            // On parcourt le tableau menu pour l'afficher
            foreach($menuAdmin as $key => $value) {
                echo '<a href="'.WEBROOT.$key.'">'.$value.'</a> ';
            }
        ?>
	</div>
	<form action="<?php echo WEBROOT.'admincommentaire/postprocess?id='.$commentaire->id ?>" method="post">
		<label for="titre">Titre :</label><input type="text" id="titre" name="titre" value="<?php echo $commentaire->titre ?>" /><br />
		<label for="contenu">Contenu :</label><br />
		<textarea id="contenu" name="contenu"><?php echo $commentaire->contenu ?></textarea><br />
		<input type="submit" value="Enregistrer" />
	</form>
</div>