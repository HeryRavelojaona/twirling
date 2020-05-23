<?php $this->title = "Connexion"; ?>
<section id="login_form" class="contact">
    <div class="container">
            <form class="form-horizontal connexion all-forms" method="post" action="../public/index.php?route=login">
                <fieldset>
                    <legend>Connexion</legend>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-12">
                        <input type="email" class="form-control" id="inputEmail" name="mail" placeholder="Email">
                        <span class="form-error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass" class="col-lg-2 control-label">Mot de passe</label>
                        <div class="col-lg-12">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                        <span class="form-error"></span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-lg-12 col-lg-offset-2 button-submit ">
                        <button type="reset" class="btn btn-danger">Effacer</button>
                        <input type="submit" name="submit" class="btn btn-primary" value="Soumettre">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-lg-12 col-lg-offset-2 btnPass">
                            <a href="../public/index.php?route=forgotpass" class="btn btn-warning btn-sm" id="forgot_pass"name="forgotPass">Mot de passe oublié ?</a>
                        </div>
                    </div>
                </fieldset>
            </form>
            <a href="../public/index.php" class="btn btn-info return">Retour</a>
            </div>
        </section>