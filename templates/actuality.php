    
 <?php $this->title = "Actualités"; ?>
 <?php include 'navbarbase.php';?>
 <!-- ======= Actuality ======= -->
    <section id="Actuality" class="actuality">
        <div class="container">
            <div class="section-title">
                <span>Actualités</span>
                <h2>Actualités</h2>
            </div>
            <div class="row">
    <?php
        foreach ($articles as $article)
        {
    ?>
        <div class="col-lg-4 fade-left">
            <div class="box">
                <a class=" actuality-click" href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>">
                    <!--Change date Format-->
                    <?php $date = new Datetime($article->getCreatedAt()); ?>
                    <img src="../public/assets/img/upload/<?= htmlspecialchars($article->getFileName());?>" class="actuality-img">
                    <span class="actuality-date"><?= htmlspecialchars($date->format('d-m-Y'));?></span>
                    <h4><?= $article->getTitle();?></h4>
                    <p><?= $article->getContent();?></p>
                    <a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>" class="read-more">Lire la suite...</a>
                </a>
            </div>
        </div>
    <?php
        }
    ?>
       
    </div>
    <div class="page">
            <ul class="pagination">
               
            <?php
               for($i=1; $i<=$nbPage; $i++){
        
                   echo '<li><a href="../public/index.php?route=actuality&page='.$i.'">'.$i.'</a></li>';
                } 
            ?>
            </ul>
        </div>

    </div>
</section>