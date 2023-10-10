<?php
function renderMenuToHTML($currentPageId) {
    // un tableau qui d\'efinit la structure du site
    $mymenu = array(
        // idPage titre
        'index' => array( 'Accueil' ),
        'cv' => array( 'Cv' ),
        'projets' => array('Mes Projets')
    );
    //...
    foreach($mymenu as $pageId => $pageParameters) {
        echo "...";
    }
    // ...
}
?>