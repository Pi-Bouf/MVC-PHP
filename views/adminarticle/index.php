<h1>Administration</h1>
<ul>
	<?php foreach($menu as $key=>$m){ ?>
		<li><a href="<?php echo WEBROOT.$key.'/index' ?>"><?php echo $m ?></a></li>
	<?php } ?>
</ul>
<h2>Liste des articles</h2>
<a href="<?php echo WEBROOT.'adminarticle/createedit' ?>">Ajouter un article</a><br />
<table>
	<tr>
		<th>Titre</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	<?php foreach($articles as $article){ ?>
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