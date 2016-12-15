<p>Article</p>
<?php
echo 'Titre: '.$article->titre;
echo '<br />Contenu: '.$article->contenu;
echo '<br />Date: '.$article->datetime;
?>

<p>Commentaire</p>
<form action="<?php echo WEBROOT.'commentaire/postprocess?idArticle='.$article->id ?>" method="post">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" /><br />
    <label for="contenu">Contenu :</label>
    <textarea name="contenu" id="contenu" name="contenu"></textarea><br /><br />
    <input type="submit" value="Envoyer !">
</form>