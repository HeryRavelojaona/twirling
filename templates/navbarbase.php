<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
        <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
          <a class="navbar-brand logo" href="index.php">SPAC</a>

          <button class="navbar-toggler" type="button" data-target="#nav_menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
          </button>
          <div class="collapse navbar-collapse justify-content-center " id="nav_menu">
            <ul class="navbar-nav ">
                  <li class="nav-item active">
                      <a class="nav-link" href="index.php">Accueil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?route=actuality">Actualités</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?route=training">Entrainements</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?route=story">Histoire du club</a>
                  </li>
                  <li class="nav-item dropdown">
        <?php
            if($this->session->get('id'))
            {
        ?>
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Admin</a>
                    <ul class="dropdown-menu" role="menu">
                    <li><a href="index.php?route=profile" class="dropdown-item">
                    <img src="assets/img/upload/<?= htmlspecialchars($this->session->get('filename'));?>" class="img-fluid rounded-circle profil-img"><br/>Profil</a></li>
            <?php if($this->session->get('status') === '1') { ?>
                    <li><a href="index.php?route=administration" class="dropdown-item">Administration</a></li>
            <?php } ?>
                    <li><a href="index.php?route=logout" class="dropdown-item">Déconnexion</a></li>
        <?php 
            }else{ 
        ?>
                    <a href="index.php?route=login" class="nav-link" ><i class="fas fa-user-lock"></i></a>   
        <?php 
        } 
        ?>
                  </li>
              </ul>
              <button class="close-btn"><i class="fas fa-times"></i></button>
          </div>
        </nav>
</header><!-- End Header -->