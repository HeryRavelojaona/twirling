<section id="contactmember" class="contact">
        <div class="container">
        <div class="section-title">
                <h2>Message aux membres</h2>
            
            </div>
            <div class="col-lg-12">
              <form action="index.php?route=contactmembers" method="post" role="form" class="email-form" id="newsletter">
                <div class="form-row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" value="<?= $this->session->get('firstname');?>"/>
                    <span class="error-contact"><?= isset($errors['name'])? $errors['name'] : '';?></span>
                  </div>
                  <div class="col-md-6 form-group">
                    <input type="email" class="form-control" name="email" id="email" value="<?= $this->session->get('mail');?>"/>
                    <span class="error-contact"><?= isset($errors['email'])? $errors['email'] : '';?></span>
                  </div>
                </div>
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