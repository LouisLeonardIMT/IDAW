<?php
require_once('template_header.php');
?>
<body>
<h1>Louis Léonard</h1>
<div class="container">
    <?php 
    require_once('template_menu.php')
    renderMenuToHTML('index');
?>
</div>
<img src="photo-Louis.jpg" alt="Une photo de moi." width="300px">
<h2>Qui suis-je ?</h2>
<p>Un étudiant à l'IMT Nord Europe spécialisé dans le domaine numérique.</p>
<?php
require_once('template_footer.php');
?>
    