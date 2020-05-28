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
                  <img src="../public/assets/img/upload/<?= htmlspecialchars($article->getFileName());?>" class="actuality-img">
                  <span class="actuality-date"><?= htmlspecialchars($date->format('d-m-Y'));?></span>
                  <h4><?= htmlspecialchars($article->getTitle());?></h4>
                  <p><?= $article->getContent();?></p>
                </div>
              </div>
            </div>
            <div class="article-return">
                <a href="../public/index.php" class="btn btn-info return">Retour</a>
            </div>
          </div>
          
        </section><!-- End Actuality  Section -->