<?php

foreach($articles as $value) {
    echo '<h3>'.$value->titre.'</h3>';
    echo '<div style="max-width: 50%;">'.$value->contenu.'</div>';
    echo '<div style=""></div>';
}

?>