<!-- ======= History Section ======= -->
<?php $this->title = "Histoire du club"; ?>
<main id="main">
<section id="Story" class="story container-fluid">

    <div class="section-title">
        <span>Histoire du club</span>
        <h2>Histoire du club</h2>
        <p></p>
    </div>

    <div class="row story-container fade-up">
    <?php foreach($stories as $story)
    {
    ?>
        <div class="col-lg-6 col-md-6 story-item">
            <img src="assets/img/upload/<?= htmlspecialchars($story->getFileName());?>" class="img-fluid story-img" alt="">
            <div class="story-info">
                <h4><?= htmlspecialchars($story->getTitle()); ?></h4>
                <p><?= $story->getContent(); ?></p>
            </div>
        </div>
    <?php
    }
    ?>
       

        <div class="col-lg-12 col-md-6 story-item text-hommage">
            <img src="assets/img/christian.jpg" class="img-fluid hommage" alt="">
            <div class="story-info">
                <h4>Hommage</h4>
                <p>Aussi, pour finir cette présentation, nous souhaitons rendre hommage à toute la famille Roncone pour leur dévouement. Ce qui a permis au club d'être ce qu'il est aujourd'hui. Tout particulièrement à nos présidents historiques,
                        Françoise Roncone et Christian Roncone. </p>
            </div>
            </div>

    </div>
    </div>
</section><!-- End history Section -->