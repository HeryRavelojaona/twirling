<?php include 'adminNavbar.php';?>
<section id="Info" class="info">
        <div class="container">
            <div class="section-title">
                <h2>Configuration</h2>
            </div>

          <div class="row d-flex align-items-center">
            <div class="col-lg-12">
              <button class="tarif-info" id="openChangePrice">Changer le tarif: <span class="show-price"><?= htmlspecialchars($config->getContribution()) ;?></span> euros de cotisation annuelle</button>
              <form action="" method="post" id="changePrice">
                  <label for="price">Tarif: </label>
                  <input type="number" name="price" placeholder="Tarif en euros">
                  <button type="button" name="submit" id="btn_change_price" class="btn btn-warning">Changer</button>
              </form>
            </div>
          </div>
        </div>
</section><!-- End Info Section -->
