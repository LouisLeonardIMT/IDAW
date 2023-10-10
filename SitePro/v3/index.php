<?php
    require_once("template_header.php");
    require_once("template_menu.php");
    $currentLang = isset($_GET['lang']) ? $_GET['lang'] : 'fr';
    $currentPageId = 'accueil';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }
?>
<header class="bandeau_haut">
<h1 class="titre">Louis Léonard</h1>
</header>
<?php
    renderMenuToHTML($currentPageId, $currentLang);
?>
<section class="corps">
<?php
    $pageToInclude = $currentLang . "/" . $currentPageId . ".php";
    if(is_readable($pageToInclude))
        require_once($pageToInclude);
    else
        require_once("error.php");
?>
</section>
<?php
require_once("template_footer.php");
?>
