<!DOCTYPE html>
<html lang="fr">

  <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">

      <title><?= $title ?></title>
      <meta content="" name="descriptison">
      <meta content="" name="keywords">

      <!-- Favicons -->
      <link href="../public/assets/img/favicon.ico" rel="icon">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <!--fontawesome CDN-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
      <!--Boostrapd CSS CDN -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

      <!-- Template Main CSS File -->
        <!--feuille de style-->
        <link rel="stylesheet" type="text/css" href="../public/assets/css/reset.css"/> <!--reset_css-->
        <link rel="stylesheet" type="text/css" href="../public/assets/css/style.css"/><!--Mobile-first-->
        <link rel="stylesheet" type="text/css" href="../public/assets/admincss/adminCss.css"/><!--Mobile-first-->
        <link rel="stylesheet" type="text/css" media="screen and (min-width: 576px)" href="../public/assets/css/tablet.css"/><!--tablet-style-->
        <link rel="stylesheet" type="text/css" media="screen and (min-width: 992px)" href="../public/assets/css/desktop.css"/><!--desktop-style-->
      <link href="../public/assets/css/style.css" rel="stylesheet">
  </head>

  <body data-spy="scroll" data-target=".navbar" data-offset="60">
  
      <!-- ======= Header ======= -->
      <header id="header" class="fixed-top">
        <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
          <a class="navbar-brand logo" href="">SPAC</a>

          <button class="navbar-toggler" type="button" data-target="#nav_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
          </button>
          <div class="collapse navbar-collapse justify-content-center " id="nav_menu">
            <ul class="navbar-nav ">
                  <li class="nav-item active">
                      <a class="nav-link" href="../public/index.php">Accueil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#about">Présentation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#services">Rejoignez-nous</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#team">Team</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../public/index.php?route=actuality">Actualités</a>
                  </li>
                  <li class="nav-item dropdown">
        <?php
            if($this->session->get('id'))
            {
        ?>
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">Admin</a>
                    <ul class="dropdown-menu" role="menu">
                    <li><a href="../public/index.php?route=profile" class="dropdown-item">
                    <img src="../public/assets/img/hoby.png" class="img-fluid rounded-circle profil-img"><br/>Profil</a></li>
            <?php if($this->session->get('role') === 'admin') { ?>
                    <li><a href="../public/index.php?route=administration" class="dropdown-item">Administration</a></li>
            <?php } ?>
                    <li><a href="../public/index.php?route=logout" class="dropdown-item">Déconnexion</a></li>
        <?php 
            }else{ 
        ?>
                    <a href="../public/index.php?route=login" class="nav-link" ><i class="fas fa-user-lock"></i></a>   
        <?php 
        } 
        ?>
                  </li>
              </ul>
              <button class="close-btn"><i class="fas fa-times"></i></button>
          </div>
        </nav>
      </header><!-- End Header -->

      <div id="content">
            <?= $content ?>
        </div>


<!--JS Files -->
<script
src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>
<script src=https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js></script>
<script src="https://unpkg.com/scrollreveal"></script>
<script src="../public/assets/js/Animation.js"></script>
<script src="../public/assets/js/Utils.js"></script>
<script src="../public/assets/js/Form_ajax.js"></script>
<script src="../public/assets/js/main.js"></script>
        
</body>
<!-- ======= Footer ======= -->
<footer id="footer">
  <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>
  <div class="container">
    <div class="copyright">
      &copy; 2020 Copyright <strong><span>SPAC</span></strong>. All Rights Reserved<br/>
    </div>
    <div class="credits">
      Site réalisé par<a href=""> Hery Ravelojaona</a>
    </div>
  </div>
</footer><!-- End Footer -->
</html>
