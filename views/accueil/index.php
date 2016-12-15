<h1>Accueil - index</h1>

<h2>Liste des articles</h2>

<table>
	<tr>
		<th>Titre</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
<?php foreach($articles as $article){ ?>
	<tr>
		<td><a href="<?php echo WEBROOT.'article/detail?id='.$article->id ?>"><?php echo $article->titre ?></a></td>
		<td><?php echo $article->datetime ?></td>
		<td>TODO</td>
	</tr>
<?php } ?>
</table>