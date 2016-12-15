<div id="container">
    <?php
    foreach($articles as $key => $value) {
        echo '<div class="article">';
        echo '<div class="mdi mdi-facebook title">'.$value->titre.'</div>';
        echo '<div class="text">'.$value->contenu.'</div>';
        echo '</div>';
        echo '<div class="separator"></div>';
    }
    ?>
    <center>1 2 3 4 5 6 7 8 9 10</center>
</div>