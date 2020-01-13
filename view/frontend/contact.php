<?php
$title = 'Contact - Blog de Jean Forteroche';
$description = 'Si vous avez une quesion ou une interrogation sur le site, votre compte ou tout autre, vous êtes au bon endroit.';
$keywords = 'contact,question,jean,forteroche,formulaire,demande,compte,blog,site';

ob_start();
?>
    <div id="container_contact" class="mt-5 container mb-5">
        <div id="contact" class="row col-lg-12 mb-3">
            <form action="" method="post">
                <div class="input_contact"><i class="fas fa-user"></i> <input type="text" class="form-control" name="name" placeholder="Votre nom"></div>
                <?= $name ?? '' ?>
                <div class="input_contact"><i class="fas fa-user"></i> <input type="text" class="form-control" name="lastname" placeholder="Votre prénom"></div>
                <?= $lastname ?? '' ?>
                <div class="input_contact"><i class="fas fa-at"></i> <input type="email" class="form-control" name="email" placeholder="Votre e-mail"></div>
                <?= $email ?? '' ?>
                <div class="input_contact"><i class="fas fa-envelope"></i> <input type="text" class="form-control" name="subject" placeholder="Le sujet du message"></div>
                <?= $subject ?? '' ?>
                <div class="input_contact"><i class="fas fa-envelope"> </i><textarea class="form-control" name="message" placeholder="Votre message"></textarea></div>
                <?= $message ?? '' ?>
                <button type="submit" name="submit" class="btn btn-outline-primary button_contact">Envoyer</button>
                
                <?= $confirm ?? '' ?>
            </form>
        </div>
    </div>

<?php 
$content = ob_get_clean();
require_once('view/template.php');
?>



