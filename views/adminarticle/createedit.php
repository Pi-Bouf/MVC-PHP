<div id="container">
	<h2>Edition/création d'articles</h2>
	<div id="menuAdmin">
	    <?php
            // On parcourt le tableau menu pour l'afficher
            foreach($menuAdmin as $key => $value) {
                echo '<a href="'.WEBROOT.$key.'">'.$value.'</a> ';
            }
        ?>
	</div>
	<form enctype="multipart/form-data" action="<?php echo WEBROOT.'adminarticle/postprocess?id='.$article->id ?>" method="post">
		<label for="titre">Titre :</label><input type="text" id="titre" name="titre" value="<?php echo $article->titre ?>" /><br />
		<label for="contenu">Contenu :</label><br />
		<textarea id="contenu" name="contenu"><?php echo $article->contenu ?></textarea><br />
		<label for="article">Avatar: </label>
		<input type="file" name="articleImage" id="article">
		<input type="submit" value="Enregistrer" />
	</form>
</div>