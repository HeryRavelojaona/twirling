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
    <?php
        foreach ($articles as $article)
        {
    ?>
        <div class="col-lg-12 actuality-admin">
            
            <div class="box admin-box ">
            <?php $date = new Datetime($article->getCreatedAt()); ?>
                <div class=" col-md-10">
                    <h4>Titre: <?= htmlspecialchars($article->getTitle());?></h4>
                    <p>Créé par: <?= htmlspecialchars($article->getUserId());?></p>
                    <p>Le: <?= htmlspecialchars($date->format('d-m-Y'));?></p>
                    <p>Extrait:<br/> <?= $article->getContent() ;?></p>
                    <p><?= htmlspecialchars($article->getStatus());?></p>
                </div>
                <div class="action col-md-2">
                    <a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>" class="btn btn-info">Voir</a>
                    <a class="btn btn-warning">Modifier</a>
                    <a class="btn btn-primary">Publié</a>
                    <a class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        </div>
    <?php 
    }
    ?>
  
        </div>
    </div>
</section><!-- End Actuality Section -->
    