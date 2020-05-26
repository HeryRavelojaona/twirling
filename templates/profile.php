<?php $this->title = "Profil"; ?>

        <section class="container profile">
            <div class="row">
                    <div class="profile-part col-xl-6">
                        <a href="">
                        <img src="../public/assets/img/hoby.png" class="profil-img img-fluid rounded-circle "><br/>Photo 
                        <i class="fas fa-user-cog"></i>
                        </a>
                        <h3 class="profile-content">Nom: <?= $this->session->get('lastname') ; ?></h3>
                        <h4 class="profile-content">Prénom: <?= $this->session->get('firstname'); ?></h4>
                        <p class="profile-content">Email: <?= $this->session->get('mail'); ?></p>
                        <p class="profile-content">Role: <?= $this->session->get('role'); ?></p>
                    </div>    
                    <div class="profile-part col-xl-6 ">
                        <button  class="btn btn-warning profile-content modif-pass">Modifier votre mot de passe</button><br/>
                        <form class="connexion profile-changePass" id="change_pass" method="post" action="">
                <fieldset>
                    <div class="form-group">
                        <label for="pass" class="col-lg-2 control-label">Nouveau mot de passe</label>
                        <div class="col-lg-12">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                        
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="samePassword" class="col-lg-2 control-label">Vérification</label>
                        <div class="col-lg-12">
                        <input type="password" class="form-control" id="checkPass" name="samePassword" placeholder="Vérification">
                            <span class="form-error"></span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-lg-12 col-lg-offset-2 button-submit">
                        <input type="submit" name="submit" class="btn btn-info" id="submit" value="Changer">
                        </div>
                    </div>
                </fieldset>
            </form>
                        <div class="control-delete">
                            <button class="check-delete btn-danger">Supprimer votre compte</button>
                            <p class="go-delete">Etes vous sur ?</p>
                            <a href="../public/index.php?route=deleteAccount" class="go-delete btn btn-warning">Oui</a>
                            <button class="go-delete stop-delete btn btn-secondary">Non</button>
                        </div>
                    </div>
            </div>  
            
        </section>
        <a href="../public/index.php" class="btn btn-info profile-content">Retour</a>