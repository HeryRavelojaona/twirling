<?php $this->title = "Profil"; ?>
<?php include 'navbarbase.php';?>
        <section class="container profile">
            <div class="row">
                    <div class="profile-part col-xl-6">
                        <button type="button" id="openModal">
                            <div id="picture_profil">
                                <img src="../public/assets/img/upload/<?= isset($picture) ? $picture : ''; ?>" class="profil-img img-fluid  " ><br/>Photo 
                                <i class="fas fa-user-cog"></i>
                            </div>
                        </button>
                    
                        <!---Form for change image--->
                        <div id="myModal">
                            <form action="" method="post" enctype="multipart/form-data" id="changeImage">
                                <div class="form-group">
                                    <label for="fileUpload" class="col-lg-6 control-label">Changer de photo</label>
                                    <div class="col-lg-12">
                                        <input type="file" class="form-control" id="fileUpload" name="photo">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-lg-12 col-lg-offset-2 button-submit">
                                        <input type="submit" name="submit" class="btn btn-info" value="Changer">
                                    </div>
                                    <span class="status"></span>
                                </div>
                                <button type="button" class="changeImgClose">close</button>
                            </form>
                        </div>
                        <?php if(isset($user))
                        {
                        ?>

                            <h3 class="profile-content">Nom: <?= htmlspecialchars($user->getLastName()) ; ?></h3>
                            <h4 class="profile-content">Prénom: <?= htmlspecialchars($user->getFirstName()); ?></h4>
                            <p class="profile-content">Email: <?= htmlspecialchars($user->getEmail()); ?></p>
                            <p class="profile-content">Role: <?= htmlspecialchars($user->getRole()); ?></p>
                        <?php
                        }else{
                        ?>
                        <h3 class="profile-content">Nom: <?= $this->session->get('lastname') ; ?></h3>
                        <h4 class="profile-content">Prénom: <?= $this->session->get('firstname'); ?></h4>
                        <p class="profile-content">Email: <?= $this->session->get('mail'); ?></p>
                        <p class="profile-content">Role: <?= $this->session->get('role'); ?></p>
                        <?php 
                        };?>
                    </div>   
                    <!---Form for change Password---> 
                    <div class="profile-part col-xl-6 ">
                        <button  class="btn btn-warning profile-content modif-pass">Modifier votre mot de passe</button><br/>
                        <form class="connexion profile-changePass" id="change_password" method="post" action="">
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
                                    <button type="button" name="submit" class="btn btn-info" id="pass_validation" >Changer</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
            </div>  
            <div class="article-return">
                <a href="index.php?route=administration" class="btn btn-info return">Admin</a>
            </div>
        </section>
        