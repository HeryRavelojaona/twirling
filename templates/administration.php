<?php $this->title = "Administration"; ?>
<main id="main">
    <div class="message-for-all">
        <a class="btn btn-secondary text-message-for-all">Envoyer un message collectif <i class="fas fa-envelope-square"></i></a>
    </div>
        <!-- ======= Actuality Section ======= -->
        
    <section id="Actuality" class="actuality">
    <div class="container">
    <div class="section-title">
        <h2>Publications</h2>
        <?= $this->session->show('addarticle'); ?>
    </div>
    <div class="message-for-all">
          <a href="../public/index.php?route=addarticle" class="btn btn-primary text-message-for-all">Ajouter une nouvelle actualité <i class="fas fa-plus-circle"></i></a>
    </div>
    <div class="row">
        <div class="col-lg-12 actuality-admin">
        <div class="box admin-box">
            <div class="">
            <h4>Titre: gala</h4>
            <p>Créé par: Sindy</p>
            <p>Le: 12/02/12021</p>
            <p>Status</p>
            </div>
            <div class="action">
            <a href="article.html" class="btn btn-info">Voir</a>
            <a class="btn btn-warning">Modifier</a>
            <a class="btn btn-primary">Publié</a>
            <a class="btn btn-danger">Supprimer</a>
            </div>
        </div>
        </div>
        <div class="col-lg-12 actuality-admin">
        <div class="box admin-box">
            <div class="">
            <h4>Titre: gala</h4>
            <p>Créé par: Sindy</p>
            <p>Le: 12/02/12021</p>
            <p>Status</p>
            </div>
            <div class="action">
            <a href="article.html" class="btn btn-info">Voir</a>
            <a class="btn btn-warning">Modifier</a>
            <a class="btn btn-primary">Publié</a>
            <a class="btn btn-danger">Supprimer</a>
            </div>
        </div>
        </div>
        </div>
    </div>
    </div>
</section><!-- End Actuality Section -->
    