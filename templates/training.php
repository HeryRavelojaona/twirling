<?php $this->title = "Entrainements"; ?>
<?php include 'navbarbase.php';?>
 <!-- ======= Training ======= -->
 <main id="main">
  <!-- ======= Training Section ======= -->
  <section id="Training" class="training">
    <div class="container">

      <div class="section-title">
        <span>Entrainements</span>
        <h2>Entrainements</h2>
        <p></p>
      </div>

      <div class="row">

      <?php foreach($events as $event)
      {
      ?>
        <div class="col-lg-3 col-md-6 fade-left">
          <div class="box">
            <h3><?= htmlspecialchars($event->getTitle());?></h3>
            <h4><?= htmlspecialchars($event->getPlace());?></h4>
            <ul>
              <li><?= htmlspecialchars($event->getAddress());?></li>
              <li>De <strong class="training-date"><?= htmlspecialchars(substr($event->getDateStart(), 0,5));?></strong> à <strong class="training-date"><?= htmlspecialchars(substr($event->getDateEnd(), 0,5));?></strong></li>
            </ul>
            <p><?= isset($event)? htmlspecialchars($event->getComment()):'';?></p>
          </div>
        </div>
      <?php
      }
      ?>
       
      </div>

    </div>
  </section>