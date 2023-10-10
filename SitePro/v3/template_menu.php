<?php
function renderMenuToHTML($currentPageId, $currentLang) {
    // un tableau qui définit la structure du site
    $mymenu = array(
        // idPage titre
        'accueil' => array('Accueil'),
        'cv' => array('CV'),
        'projets' => array('Mes Projets'),
        'contact' => array('Contact')
    );
    echo "<nav class='menu'>\n<ul>\n";
    foreach ($mymenu as $pageId => $pageParameters) {
        //$currentLang . "/" . $currentPageId . ".php";
        //$link = $currentLang . "/" . $pageId;
        $link = "index.php?page=" . $pageId . "&lang=" . $currentLang;
        if ($pageId == $currentPageId) {
            echo "<li><a href='" . $link . "' id='currentpage'>" . $pageParameters[0] . "</a></li>\n";
        } else {
            echo "<li><a href='" . $link . "'>" . $pageParameters[0] . "</a></li>\n";
        }
    }
    echo "</ul>\n</nav>";
}
?>