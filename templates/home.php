<?php $this->title = "Accueil"; ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="align-items-center">
        <div class="container fade-up">
          <img src="https://www.gifsanimes.com/data/media/1622/twirling-baton-image-animee-0003.gif" alt="twirling-baton-image-animee-0003" class="gif-baton fade-right " />
          <h1>Twirling-bâton<br/>Fontenay-sous-bois</h1>
          <h2>Les panthères de Fontenay vous souhaitent la bienvenue <br/>
          <?= $this->session->show('login'); ?>
          <?= $this->session->show('logout'); ?>
          </h2>
          
        </div>
      </section><!-- End Hero -->

      <main id="main">
         <!-- ======= Actuality Section ======= -->
         <section id="Actuality" class="actuality">
          <div class="container">
            <div class="section-title">
              <span>Dernières</span>
              <h2>Actualités</h2>
            </div>
            <div class="row">
            <?php
                foreach ($articles as $article)
                {
            ?>
              <div class="col-lg-6 fade-up">
                <div class="box">
              
                  <img src="assets/img/upload/<?= htmlspecialchars($article->getFileName());?>" class="actuality-img">
                  <?php $date = new Datetime($article->getCreatedAt()); ?>
                  <span class="actuality-date"> <?= htmlspecialchars($date->format('d-m-Y'));?></span>
                  <h4><?= htmlspecialchars($article->getTitle());?></h4>
                  <p><?= $article->getContent();?></p>
                  <a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>" class="read-more">Lire la suite...</a>
                </div>
              </div>
            <?php
            }
            ?>
        </section><!-- End Actuality Section -->
    
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
          <div class="container">

            <div class="row">
              <div class="col-lg-6 order-1 order-lg-2 fade-left">
                <img src="../public/assets/img/duochampionnat.jpg" class="img-fluid img-thumbnail duotwirl" alt="duo de twirl">
              </div>
              <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content fade-right">
                <h3>Qu'est ce que le twirling ?</h3>
                <p class="font-italic">
                  Oui, le Twirling bâton (ou simplement twirling) est bien une discipline issue des majorettes. Mais oubliez les défilés ! Aujourd'hui le Twirling Bâton est une discipline sportive reconnue à part entière. Une discipline sportive associant :
                </p>
                <ul>
                  <li><i class="far fa-check-circle"></i> Des mouvements de gymnastique rythmique.</li>
                  <li><i class="far fa-check-circle"></i> La manipulation d'un bâton de twirling.</li>
                  <li><i class="far fa-check-circle"></i> De la danse et de la théâtralité.</li>
                </ul>
                <p>
                  C'est un sport qui associe des mouvements de bâton classés par catégorie (rouler, lancers, maniement général qu'on appelle aussi les mouvements « autres ») ainsi que des mouvements de gymnastique tels que ceux de gymnastique rythmique.
                   Il s'agit ensuite de présenter une chorégraphie sur musique. Visuellement le twirling bâton se distingue des majorettes par son aspect sportif et compétitif, tout en y mêlant l'art de la danse. Il devient ainsi plus proche de la gymnastique et du patinage. Les athlètes dansent et manipulent le bâton en même temps pendant un temps minimal qui dépend de leur catégorie :
                    poussin(e)s, benjamin(e)s, minimes, cadet(te)s, juniors ou seniors. C'est un sport artistique, il développe des qualités de dynamisme, d’harmonie et d’agilité. En effet, les twirleurs se doivent d’allier la grâce au maniement du bâton.
                </p>
              </div>
            </div>

          </div>
        </section><!-- End About Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
          <div class="container">

            <div class="section-title">
              <span>Rejoignez-nous</span>
              <h2>Rejoignez-nous</h2>
              <p>Un sport pour tous, dans une superbe ambiance</p>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch fade-right">
                <div class="icon-box">
                  <img src="../public/assets/img/groupe-reduit.jpg" class="img-fluid img-services rounded-circle" alt="">
                  <h4><a href="">Une équipe soudée</a></h4>
                  <p>Des évenements organisés avec les licenciés et leurs familles</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 fade-up">
                <div class="icon-box">
                  <img src="../public/assets/img/groupe.png" class="img-fluid img-services rounded-circle" alt="">
                  <h4><a href="">Des équipes</a></h4>
                  <p>Prenez part à une équipe pour partager des chorégraphies et des compétitions à plusieurs </p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 fade-left">
                <div class="icon-box">
                  <img src="../public/assets/img/linapodium.png" class="img-fluid img-services rounded-circle" alt="">
                  <h4><a href="">Les compétitions</a></h4>
                  <p>-	Testez votre progression et remportez des médailles en vous mesurant à d’autres sportifs dans la France entière  </p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 fade-right">
                <div class="icon-box">
                  <img src="../public/assets/img/solodanse.jpg" class="img-fluid img-services rounded-circle" alt="">
                  <h4><a href="">Des solos</a></h4>
                  <p>Amusez-vous avec des chorégraphies spécialement faites pour vous </p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 fade-up">
                <div class="icon-box">
                  <img src="../public/assets/img/duochampionnat.jpg" class="img-fluid img-services rounded-circle" alt="">
                  <h4><a href="">Des duos</a></h4>
                  <p>-	Trouvez un.e partenaire de twirl pour partager une chorégraphie et le podium des compétitions</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 fade-left">
                <div class="icon-box">
                  <img src="../public/assets/img/shanaetcopine.png" class="img-fluid img-services rounded-circle" alt="">
                  <h4><a href="">Mixtes et pour tous les âges</a></h4>
                  <p>Un sport pour tous, à apprendre et pratiquer ensemble à tous les âges. Il n’y a pas d’âge pour débuter !</p>
                </div>
              </div>
            </div>
          </div>
        </section><!-- End Services Section -->

      <!-- ======= Info Section ======= -->
      <section id="Info" class="info">
        <div class="container">

          <div class="row d-flex align-items-center fade-left">
           <img src="../public/assets/img/danseuse.png" alt="twirling-baton" class="gif fade-up"/></a>
            <div class="col-lg-6 col-md-12 col-12">
              <p class="tarif-info">Inscription à partir de 6 ans<br/> Mixtes</p>
              <p class="tarif-info">Ouvert à tous et à toutes</p>
            </div>

            <div class="col-lg-6 col-md-12 col-12">
              <p class="tarif-info">Tarif: 180 euros de cotisation annuelle</p>
            </div>

            <div class="col-lg-12 col-md-12 col-12">
              <p class="category-info categories">Catégories:</p>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
              <p class="category-info">Poussines<br/> de 6 à 7 ans</p>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
              <p class="category-info">Benjamines<br/> de 8 à 10 ans</p>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
              <p class="category-info">Minimes<br/> de 11 à 12 ans</p>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
              <p class="category-info">Cadettes<br/> de 13 à 14 ans</p>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
              <p class="category-info">Juniors<br/> de 15 à 17 ans</p>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
              <p class="category-info">Séniors<br/> à partir 18 ans</p>
            </div>

          </div>

        </div>
      </section><!-- End Info Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team">
          <div class="container">

            <div class="section-title">
              <span>Bénévoles</span>
              <h2>Team</h2>
              <p>Une équipe qui prendra soin de vous</p>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch fade-right">
                <div class="member">
                  <img src="../public/assets/img/hoby.png" class="img-fluid " alt="">
                  <h4>Hoby Ravelojaona</h4>
                  <span>Président</span>
                  <p>
                    Dans l'association depuis 2003 et
                    successeur de Christian Roncone.
                  </p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch fade-up">
                <div class="member">
                  <img src="../public/assets/img/entraineur.jpg" class="img-fluid" alt="entraineur">
                  <h4>Sindy</h4>
                  <span>Entraineur</span>
                  <p>
                    Ancienne licenciée depuis 1994, diplôme d'instructeur de club obtenu en 2008.
                    Juge national 3 en 2009 Sindy saura vous guider au mieux dans votre pratique pour vous faire progresser.
                  </p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch fade-left">
                <div class="member">
                  <img class="img-fluid thumbnail" src="../public/assets/img/tresoriere.jpg" alt="photo">
                  <h4>Sonia</h4>
                  <span>Trésorière</span>
                  <p>
                    Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
                  </p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch fade-right">
                <div class="member">
                  <img class="img-fluid thumbnail" src="../public/assets/img/aurore.jpg" alt="photo">
                  <h4>Aurore</h4>
                  <span>Secrétaire</span>
                  <p>
                    Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
                  </p>
                </div>
              </div>

            </div>

          </div>
        </section><!-- End Team Section -->

      </section><!-- End Portfolio Section -->