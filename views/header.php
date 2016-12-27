<!DOCTYPE html>
<html lang="fr">

<head>
    <title>MVC</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../styles/miw.js"></script>
    <!-- <script src="../styles/snow.js"></script> -->
    <link href="../styles/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/1.7.22/css/materialdesignicons.min.css">
</head>

<body>
    <div id="menu">
        <?php
            // On parcourt le tableau menu pour l'afficher
            foreach($menu as $key => $value) {
                echo '<a href="'.WEBROOT.$key.'">'.$value.'</a> ';
            }
        ?>
    </div>
    <div id="header">
    </div>