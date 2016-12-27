<div id="container">
	<h2>Liste des users</h2>
	<div id="menuAdmin">
	    <?php
            // On parcourt le tableau menu pour l'afficher
            foreach($menuAdmin as $key => $value) {
                echo '<a href="'.WEBROOT.$key.'">'.$value.'</a> ';
            }
        ?>
	</div>
	<div class="list">
		<a href="<?php echo WEBROOT.'adminuser/createedit' ?>">Ajouter un utilisateur</a><br />
		<table>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Statut</th>
				<th>Admin/Visiteur</th>
				<th>Action</th>
			</tr>
			<?php foreach($users as $user){ ?>
				<tr>
					<td><?php echo $user->name ?></td>
					<td><?php echo $user->email ?></td>
					<td><?php echo $user->actif?'Actif':'Inactif' ?></td>
					<td><?php echo $user->admin?'Admin':'Visiteur' ?></td>
					<td>
						<a href="<?php echo WEBROOT.'adminuser/createedit?id='.$user->id ?>">Modifier</a>
						<a href="<?php echo WEBROOT.'adminuser/delete?id='.$user->id ?>">Supprimer</a>
					</td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>