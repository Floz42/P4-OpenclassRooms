<?php
namespace Blog\view\frontend;

$title = 'Biographie de Jean Forteroche, les dates clés';
$description = 'Toutes les dates clés de la vie de Jean Forteroche, de sa naissance à la création de ce blog.';
$keywords = 'biographie,jean,forteroche,écrivain,roman,romans,alaska,saint-etienne,livres,billet,simple';

ob_start();
?>  
    <div id="container_bio" class="mt-5 container mb-5">
        <div id="biographie" class="row col-lg-6 col-md-12 mb-3">
            <div id="scroll"></div>
            <h4 class="one_title mb-5">
                Biographie de Jean Forteroche - Dates clés :
            </h4>
            <pre>
                <i class="fas fa-bookmark word_color"></i> <strong>23 mai 1960</strong>
                Naissance de Jean Forteroche à <span class="word_color">Saint-Etienne</span>. Il sera l'ainé d'une fraterie de cinq frères et soeurs.

                <i class="fas fa-bookmark word_color"></i> <strong>12 avril 1978</strong>
                À seulement 18 ans il sort sont premier ouvrage <span class="word_color">"Ma belle Saint-Etienne"</span> ou il y décrit l'évolution de sa belle ville natale.

                <i class="fas fa-bookmark word_color"></i> <strong>10 avril 1979</strong>
                Lors d'une visite à Paris en 1977 Jean est tombé amoureux d'une toute jeune actrice: <span class="word_color">Marinette.</span> ils décident d'unir leurs voeux le 10 avril 1979 là ou tout a commencer, à <span class="word_color">Paris</span>. 

                <i class="fas fa-bookmark word_color"></i> <strong>10 septembre 1981</strong>
                Naissance de son premier enfant <span class="word_color">Florian</span> dont il espère secrètement qu'il suivra plus tard les pas de son Papa.

                <i class="fas fa-bookmark word_color"></i> <strong>1er février 1983</strong>
                Naissance de son deuxième enfant, cette fois-ci une petite fille nommée <span class="word_color">Enola</span>.

                <i class="fas fa-bookmark word_color"></i> <strong>2 juin  1985</strong>
                Sortie de son deuxième livre <span class="word_color">"Italie, pays du bonheur"</span> . Jean commence alors ses voyages et tombe amoureux de l'Italie ou il s'installe avec sa femme et ses deux enfants. Son amour pour la <span class="word_color">Cité des Doges</span> l'emmène à y poser ses valises et écrire ce roman qui fait voyager au travers de toute l'Italie.

                <i class="fas fa-bookmark word_color"></i> <strong>8 mai 2004</strong>
                Décès de son <span class="word_color">papa</span> à l'age de 82ans d'une chute d'une falaise lors d'une balade hors piste à ski, pour s'en remettre, il emmène sa maman en tour du monde.

                <i class="fas fa-bookmark word_color"></i> <strong>25 septembre 2007</strong>
                Sortie de son livre <span class="word_color">"Des étoiles plein les yeux"</span> ou il y racconte son tour du monde accompagné de sa maman, sa femme et ses deux enfants. On y retrouve les nombreux pays que Jean à visité et les chaleureuses rencontres qu'il y a fait.

                <i class="fas fa-bookmark word_color"></i> <strong>19 octobre 2011</strong>
                Sa fille Enola donne naissance à des faux-jumeaux <span class="word_color">Michel et Chloé</span>. Jean prend alors un peu de recul sur l'écriture pour s'occuper de toute sa petite famille.
                
                <i class="fas fa-bookmark word_color"></i> <strong>11 janvier 2018</strong>
                Jean s'aperçoit qu'il n'a jamais visité <span class="word_color">l'Alaska</span> et entreprend donc un voyage. Il en tombe amoureux et décide finalement d'y poser ses valises. Ce pays lui redonne le goût de l'écriture, il entreprend alors de créer ce blog ...

            </pre>        
        </div>
        <div data-aos="fade-left" data-aos-duration="2000" id="portrait" class="col-lg-6 col-xs-3">
            <img src="public/img/portrait.png" alt="portrait Jean Forteroche">
        </div>
    </div>
<?php 

$content = ob_get_clean();
require_once('view/template.php');
?>



