<?php $this->title = "Article"; ?>
       <!-- ======= Actuality Section ======= -->
       <section id="Actuality" class="actuality">
          <div class="container">

            <div class="section-title">
              <span>Actualités</span>
              <h2>Actualités</h2>
            </div>
            <div class="row">

              <div class="col-lg-12 fade-right">
                <div class="box article-box">
                <?php $date = new Datetime($article->getCreatedAt()); ?>
                  <img src="assets/img/upload/<?= htmlspecialchars($article->getFileName());?>" class="actuality-img">
                  <span class="actuality-date">Publié le: <?= htmlspecialchars($date->format('d-m-Y'));?></span>
                  <h4><?= htmlspecialchars($article->getTitle());?></h4>
                  <p><?= $article->getContent();?></p>
                </div>
              </div>
            </div>
            <div class="article-return">
                <a href="index.php" class="btn btn-info return">Accueil</a>
                <a href="index.php?route=administration" class="btn btn-info return">Admin</a>
            </div>
          </div>
          
        </section><!-- End Actuality  Section -->