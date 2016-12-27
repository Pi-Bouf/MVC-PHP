<div id="container">
	<h2>Liste des commentaire</h2>
	<div id="menuAdmin">
	    <?php
            // On parcourt le tableau menu pour l'afficher
            foreach($menuAdmin as $key => $value) {
                echo '<a href="'.WEBROOT.$key.'">'.$value.'</a> ';
            }
        ?>
	</div>
	<div class="list">
		<table>
			<tr>
				<th>Titre</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
			<?php foreach($commentaires as $commentaire){ ?>
				<tr>
					<td><?php echo $commentaire->titre ?></td>
					<td><?php echo $commentaire->datetime ?></td>
					<td>
						<a href="<?php echo WEBROOT.'admincommentaire/edit?id='.$commentaire->id ?>">Modifier</a>
						<a href="<?php echo WEBROOT.'admincommentaire/delete?id='.$commentaire->id ?>">Supprimer</a>
					</td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>