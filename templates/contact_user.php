<?php $this->title = "Contact"; ?>
<?php include 'adminNavbar.php';?>
<section id="contactuser" class="contact">
        <div class="container">
        <div class="section-title">
                <h2>Message pour <?= htmlspecialchars($user->getFirstName());?> </h2>
            
            </div>
            <div class="col-lg-12">
              <form action="index.php?route=contactuser&userId=<?= htmlspecialchars($user->getId());?>" method="post" role="form" class="email-form" id="newsletter">
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet"/>
                  <span class="error-contact"><?= isset($errors['subject'])? $errors['subject'] : '';?></span>
                </div>
                <div class="form-group">
                  <textarea class="form-control tiny" name="message" rows="15"></textarea>
                  <span class="error-contact"><?= isset($errors['message'])? $errors['message'] : '';?></span>
                </div>
                <div class="text-center"><input type="submit" name="submit" id="contactall_sent" value="Envoyez"></div>
              </form>
            </div>
          </div>
        </div>
</section><!-- End Contact Section -->