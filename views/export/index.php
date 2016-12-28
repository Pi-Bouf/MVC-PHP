<div id="container">
    <h2>Exportation des fichiers CSV</h2>
	<div id="menuAdmin">
	    <?php
            // On parcourt le tableau menu pour l'afficher
            foreach($menuAdmin as $key => $value) {
                echo '<a href="'.WEBROOT.$key.'">'.$value.'</a> ';
            }
        ?>
	</div>
    <form method="post" action="<?php echo WEBROOT; ?>export/postprocess">
    <label for="Nom">Nom des sauvegardes:</label>
    <input type="text" name="nom" id="Nom" value="BACKUP_<?php echo date("Y_m_d-H_i_s"); ?>">
    <input type="submit" value="Exporter">
    </form>
    <center><small><i>Les sauvegardes seront dans le dossier <b>upload/backupCSV/</b>.</i></small></center>
</div>