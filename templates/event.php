 <!-- ======= Training Section ======= -->
 <?php $this->title = "Evenements"; ?>
 <?php include 'navbarbase.php';?>
<section id="Training" class="training">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="box">
                <h3><?= htmlspecialchars($event->getTitle());?></h3>
                <h4><?= htmlspecialchars($event->getPlace());?></h4>
                <ul>
                    <li><?= htmlspecialchars($event->getAddress());?></li>
                    <li>De <strong><?= htmlspecialchars(substr($event->getDateStart(), 0,5));?></strong> à <strong><?= htmlspecialchars(substr($event->getDateEnd(), 0,5));?></strong></li>
                </ul>
                <p><?= isset($event)? htmlspecialchars($event->getComment()):'';?></p>
            </div>
        </div>
    </div>
</section>