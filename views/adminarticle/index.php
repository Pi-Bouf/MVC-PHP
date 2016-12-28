<div id="container">
	<h2>Liste des articles</h2>
	<div id="menuAdmin">
	    <?php
            // On parcourt le tableau menu pour l'afficher
            foreach($menuAdmin as $key => $value) {
                echo '<a href="'.WEBROOT.$key.'">'.$value.'</a> ';
            }
        ?>
	</div>
	<div class="list">
		<a href="<?php echo WEBROOT.'adminarticle/createedit' ?>">Ajouter un article</a><br />
		<table>
			<tr>
				<th>Titre</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		
			<?php
			foreach($articles as $article){ ?>
				<tr>
					<td><?php echo $article->titre ?></td>
					<td><?php echo $article->datetime ?></td>
					<td>
						<a href="<?php echo WEBROOT.'adminarticle/createedit?id='.$article->id ?>">Modifier</a>
						<a href="<?php echo WEBROOT.'adminarticle/delete?id='.$article->id ?>">Supprimer</a>
					</td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>