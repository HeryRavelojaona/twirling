<?php $this->title = "Accueil"; ?>
<!-- ======= Hero Section ======= -->
<?php include 'homeNavbar.php';?>
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
                        <a class=" actuality-click" href="index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>">
                          <img src="assets/img/upload/<?= htmlspecialchars($article->getFileName());?>" class="actuality-img" alt="photo actualité">
                          <?php $date = new DateTimeFrench($article->getCreatedAt()); ?>
                          <span class="actuality-date">Publié le <?= htmlspecialchars($date->format('d-F-Y'));?></span>
                          <h4><?= htmlspecialchars($article->getTitle());?></h4>
                          <p><?= $article->getContent();?></p>
                          <a href="index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>" class="read-more">Lire la suite...</a>
                        </a>
                    </div>
              </div>
        <?php
        }
        ?>
          </div>
  </section><!-- End Actuality Section -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row">
        <div class="col-lg-6 order-1 order-lg-2 fade-left">
          <img src="assets/img/duochampionnat.jpg" class="img-fluid img-thumbnail duotwirl" alt="duo de twirl">
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
            <img src="assets/img/groupe-reduit.jpg" class="img-fluid img-services rounded-circle" alt="twirling">
            <h4><a href="">Une équipe soudée</a></h4>
            <p>Des évenements organisés avec les licenciés et leurs familles</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 fade-up">
          <div class="icon-box">
            <img src="assets/img/groupe.png" class="img-fluid img-services rounded-circle" alt="twirling">
            <h4><a href="">Des équipes</a></h4>
            <p>Prenez part à une équipe pour partager des chorégraphies et des compétitions à plusieurs </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 fade-left">
          <div class="icon-box">
            <img src="assets/img/linapodium.png" class="img-fluid img-services rounded-circle" alt="twirling">
            <h4><a href="">Les compétitions</a></h4>
            <p>-	Testez votre progression et remportez des médailles en vous mesurant à d’autres sportifs dans la France entière  </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 fade-right">
          <div class="icon-box">
            <img src="assets/img/solodanse.jpg" class="img-fluid img-services rounded-circle" alt="twirling">
            <h4><a href="">Des solos</a></h4>
            <p>Amusez-vous avec des chorégraphies spécialement faites pour vous </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 fade-up">
          <div class="icon-box">
            <img src="assets/img/duochampionnat.jpg" class="img-fluid img-services rounded-circle" alt="Twirling">
            <h4><a href="">Des duos</a></h4>
            <p>-	Trouvez un.e partenaire de twirl pour partager une chorégraphie et le podium des compétitions</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0 fade-left">
          <div class="icon-box">
            <img src="assets/img/shanaetcopine.png" class="img-fluid img-services rounded-circle" alt="Twirling">
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
          <img src="assets/img/danseuse.png" alt="twirling-baton" class="gif fade-up"/></a>
          <div class="col-lg-6 col-md-12 col-12">
            <p class="tarif-info">Inscription à partir de 6 ans<br/> Mixtes</p>
            <p class="tarif-info">Ouvert à tous et à toutes</p>
          </div>

          <div class="col-lg-6 col-md-12 col-12">
            <p class="tarif-info">Tarif: <?= htmlspecialchars($config->getContribution()) ;?> euros de cotisation annuelle</p>
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
      <?php foreach($team as $user)
      {
      ;?>

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch fade-right">
            <div class="member">
              <?php if(!$user->getFileName())
              {
              ;?>
                <img src="assets/img/upload/1591624659.jpg" class="img-fluid " alt="Photo des membres">
              <?php
              }else
              {?>
                <img src="assets/img/upload/<?= htmlspecialchars($user->getFileName());?>" class="img-fluid " alt="Photo des membres">
              <?php
              }
              ;?>
               
                <h4><?= htmlspecialchars($user->getFirstName());?> </h4>
                <span><?= htmlspecialchars($user->getRole());?></span>
                <div><?= isset($user)? $user->getComment():'';?></div>
            </div>
        </div>
      <?php
      }
      ;?>

      </div>

    </div>
  </section><!-- End Team Section -->

</section><!-- End Portfolio Section -->
<section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
              <span>Contact</span>
              <h2>Contact</h2>
            </div>

            <div class="row" data-aos="fade-up">
              <div class="col-lg-6">
                <div class="info-box ">
                  <i class="fas fa-map-pin"></i>
                  <h3>Adresse</h3>
                  <p class="contact-address"><?= htmlspecialchars($config->getAddress()) ;?></p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="info-box ">
                <i class="fas fa-envelope-square"></i>
                <h3>Email</h3>
                <p class="contact-email"><?= htmlspecialchars($config->getMail()) ;?></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="info-box">
                <i class="fas fa-phone-volume"></i>
                <h3>Téléphone</h3>
                <p class="contact-phone">0<?= htmlspecialchars($config->getPhone()) ;?></p>
              </div>
            </div>

          </div>

          <div class="row fade-up">

            <div class="col-lg-6 map">
                <iframe class="mb-4 mb-lg-0 google-map" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d10500.752352180461!2d2.477525011060456!3d48.85462365521368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sGymnase%20salvador%20allende%2094120!5e0!3m2!1sfr!2sfr!4v1589540536859!5m2!1sfr!2sfr" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>

            <div class="col-lg-6">
              <form action="#" method="post" class="email-form" id="contact_form">
                <div class="form-row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="NOM"/>
                    <span class="error-contact error-name"></span>
                  </div>
                  <div class="col-md-6 form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"/>
                    <span class="error-contact error-email"></span>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet"/>
                  <span class="error-contact error-subject"></span>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                  <span class="error-contact error-content"></span>
                </div>
                <div class="text-center"><button type="submit" name="submit" id="contact_sent">Envoyez</button></div>
              </form>
            </div>
          </div>
        </div>
</section><!-- End Contact Section -->