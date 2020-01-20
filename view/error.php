<?php
namespace Blog;

ob_start();
?>
    <!-- For redirection errors -->
    <div id="container_error" class="mt-5 container-fluid">
        <div id="error" class="mx-auto mb-5 text-center col-lg-8 col-xs-10">
            <div id="scroll"></div>
            <div class="text-center alert alert-danger p-5"><h2>ERREUR : CETTE PAGE N'EXISTE PAS.</div>
            <p> Merci de cliquer <a href="index.php?action=accueil">ici</a> pour revenir à la page d'accueil.</p>
        </div>
    </div>
<?php 
$content = ob_get_clean();
require_once('view/template.php');
?>



