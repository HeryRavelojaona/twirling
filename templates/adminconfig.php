<?php $this->title = "Configuration"; ?>
<?php include 'adminNavbar.php';?>
<section id="Info" class="info admin-info-part">
        <div class="container">
            <div class="section-title">
                <h2>Configuration</h2>
            </div>

            <div class="config-part">
                <div class="col-lg-12">
                  <button class="tarif-info admin-info" id="openChangePrice">Changer le tarif:<br/> <span class="show-price"><?= htmlspecialchars($config->getContribution()) ;?></span> euros de cotisation annuelle</button>
                  <form action="" method="post" id="changePrice">
                      <label for="price">Tarif: </label>
                      <input type="number" name="price" id="new_price" placeholder="Tarif en euros">
                      <button type="button" name="submit" id="btn_change_price" class="btn btn-warning">Changer</button>
                  </form>
                </div>
            </div>
            
            <div class="config-part">
                <div class="col-lg-12">
                  <button class="tarif-info admin-info" id="openChangeAddress">Changer l'adresse :<br/> <span class="show-address"><?= htmlspecialchars($config->getAddress()) ;?></span></button>
                  <form action="" method="post" id="changeAddress">
                      <label for="address">Adresse : </label>
                      <input type="text" name="address" id="new_address" placeholder="Adresse">
                      <button type="button" name="submit" id="btn_change_address" class="btn btn-warning">Changer</button>
                  </form>
                </div>
            </div>

            <div class="config-part">
                <div class="col-lg-12">
                  <button class="tarif-info admin-info" id="openChangeEmail">Changer l'email :<br/> <span class="show-email"><?= htmlspecialchars($config->getMail()) ;?></span></button>
                  <form action="" method="post" id="changeEmail">
                      <label for="email">Email : </label>
                      <input type="email" name="email" id="new_email" placeholder="Email">
                      <button type="button" name="submit" id="btn_change_email" class="btn btn-warning">Changer</button>
                  </form>
                </div>
            </div>

            <div class="config-part">
                <div class="col-lg-12">
                  <button class="tarif-info admin-info" id="openChangePhone">Changer de téléphone :<br/> <span class="show-phone">0<?= htmlspecialchars($config->getPhone()) ;?></span></button>
                  <form action="" method="post" id="changePhone">
                      <label for="phone">Téléphone: </label>
                      <input type="tel" name="phone" id="new_phone" placeholder="Numéro">
                      <button type="button" name="submit" id="btn_change_phone" class="btn btn-warning">Changer</button>
                  </form>
                </div>
            </div>
        
          </div>
</section><!-- End Info Section -->
