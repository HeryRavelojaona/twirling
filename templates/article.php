<?php $this->title = "Article"; ?>
       <!-- ======= Actuality Section ======= -->
       <section id="Actuality" class="actuality">
          <div class="container">

            <div class="section-title">
              <span>Actualités</span>
              <h2>Actualités</h2>
            </div>
            <div class="row">

              <div class="col-lg-12">
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
              <?php if($this->session->get('status')== 1)
              {?>
                <a href="index.php?route=updatearticle&articleId=<?= htmlspecialchars($article->getId());?>" class="btn btn-info return">Editer</a>
              <?php
              }
              ;?>
                
            </div>
          </div>
          
        </section><!-- End Actuality  Section -->