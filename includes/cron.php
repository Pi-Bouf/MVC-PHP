<?php
/* ####################################################################### */
// Ce système va permettre, à chaque connexion sur la page (par un visiteur), vérifier la date
// de la dernière sauvegarde. Si elle est dépassé (selon l'interval), alors on en refait une.
/* ####################################################################### */


// Intervalle en seconde entre chaque sauvegarde (3600 * 24 pour en faire une par jour)
$interval = 3600; //     /!\ /!\ /!\ /!\ Si vous mettez à 10 et que vous regardez bien le dossier, une sauvegarde automatique apparaitra toutes les 10 secondes
// Si le fichier avec le timestamp existe, alors on check la date
if(file_exists(ROOT.'upload/backupCSV/timestamp_last_save_auto')) {
    $file = fopen(ROOT.'upload/backupCSV/timestamp_last_save_auto', 'r');
    $time = fgets($file);
    fclose($file);
    if($time + $interval <= time()) {
        $nom = "BACKUP_AUTO_".date("Y_m_d-H_i_s");
        UserModel::export($nom);
        ArticleModel::export($nom);
        CommentaireModel::export($nom);
        $file = fopen(ROOT.'upload/backupCSV/timestamp_last_save_auto', 'w');
        fwrite($file, time());
        fclose($file);
    }
} 
// Sinon on le crée avec ne timestamp de maintenant
else {
    $file = fopen(ROOT.'upload/backupCSV/timestamp_last_save_auto', 'w');
    fwrite($file, time());
    fclose($file);
}
?>