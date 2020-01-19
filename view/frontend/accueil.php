<?php
namespace Blog\view\frontend;
ob_start();
?>
    <div id="container_home" class="mt-5 container-fluid">
        <div id="accueil" class="row col-lg-12">
            <h4 class="one_title">
                Bienvenue sur le blog de Jean Forteroche <br>
            </h4>
            <div class="line_nav mb-3"></div>
            <p>
                Vous allez vivre sur ce blog une <span class="word_color">expérience unique</span>. Jean Forteroche vous fait découvrir ici <span class="word_color">l'Alaska</span> comme vous ne l'avez jamais vue.
                Tout ceci à travers différents billets qui constitueront son <span class="word_color">nouveau roman</span>.
            </p> 
            <div class="line_nav mb-3"></div>
            <p>
                Si vous ne connaissez pas la vie passionnante de <span class="word_color">Jean Forteroche</span> nous avons mis à votre disposition une page <span class="word_color">Biographie</span> qui retrace son parcours professionnel et personnel.
            </p>
            <div class="line_nav mb-3"></div>
            <p>
                Pour une meilleure interactivité vous pouvez laisser vos <span class="word_color">commetaires</span> en dessous de chaque article.
            </p>
            <div class="line_nav mb-3"></div>
            <p>
                Pour toute question ou suggestion concernant le site, l'auteur ou autre, nous avons mis à votre disposition une <span class="word_color">page contact</span>.
            </p>
        </div>
    </div>
<?php 
$content = ob_get_clean();
require_once('view/template.php');
?>



