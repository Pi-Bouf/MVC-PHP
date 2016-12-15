<h1>Administration</h1>
<ul>
	<?php foreach($menu as $key=>$m){ ?>
		<li><a href="<?php echo WEBROOT.$key.'/index' ?>"><?php echo $m ?></a></li>
	<?php } ?>
</ul>
<ul>
	<li><a href="<?php echo WEBROOT.'adminarticle/index' ?>">Articles</a></li>
	<li><a href="<?php echo WEBROOT.'admincommentaire/index' ?>">Commentaires</a></li>
	<li><a href="<?php echo WEBROOT.'adminuser/index' ?>">User</a></li>
</ul>