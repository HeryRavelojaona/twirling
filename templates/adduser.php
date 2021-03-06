<?php $this->title = "Ajouter un article"; ?>
<?php include 'adminNavbar.php';?>
 <!-- ======= Actuality Section ======= -->
        <section id="Actuality" class="actuality actuality-edit">
        <div class="container">

            <div class="section-title">
                <span>Nouvel</span>
                <h2>Utilisateur</h2>
            </div>
            <div class="row">

                <form class="col-lg-12" id="form_user" action="index.php?route=adduser" method="post" enctype="multipart/form-data">
                    <div class="box addarticlebox">
                        <div class="form-group ">
                            <label>Choisir la catégorie</label>
                            <div class="col-lg-12">
                                <select name="choice" class="category-choice">
                                    <option value="admin" class="option">Membre du bureau</option>
                                    <option value="member" class="option" id="adherent_choice">Adhérent</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="photo" class="col-lg-6 control-label">Ajouter une photo</label>
                            <div class="col-lg-12">
                                <input type="file" class="form-control" id="fileActuality" name="photo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="col-lg-6 control-label">Nom</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="new_user_name" name="lastName" >
                                <span class="form-error"><?= isset($errors['lastName'])? $errors['lastName'] : '';?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-lg-6 control-label">Prénom</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="new_user_firstname" name="firstName">
                                <span class="form-error"><?= isset($errors['firstName'])? $errors['firstName'] : '';?></span>
                            </div>
                        </div> 
                        <div class="form-group create-role">
                            <label for="role" class="col-lg-6 control-label">Rôle</label>
                            <div class="col-lg-12 ">
                                <select name="role" class="form-control">
                                    <option class="form-control" value="20">Bénévole</option>
                                    <option class="form-control" value="40">Entraineur</option>
                                    <option class="form-control" value="80">Secrétaire</option>
                                    <option class="form-control" value="60">Trésorier/e</option>
                                    <option class="form-control select-role" value="100">Président</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="mail" class="col-lg-6 control-label">Email</label>
                            <div class="col-lg-12">
                                <input type="email" class="form-control" id="new_user_email" name="mail">
                                <span class="form-error"><?=isset($errors['mail'])? $errors['mail'] : '';?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-lg-6 control-label">Mot de passe temporaire</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="new_user_password" name="password">
                                <span class="form-error"><?=isset($errors['password'])? $errors['password'] : '';?></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="samepassword" class="col-lg-6 control-label">Mot de passe temporaire</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="new_user_password" name="samepassword">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="comment" class="col-lg-6 control-label">Commentaire</label>
                            <div class="col-lg-12">
                                <textarea class="form-control  tiny" id="userContent" name="comment"></textarea>
                                <span>Commentaire non obligatoire</span>
                            </div>
                            
                        </div>   
                        <div class="form-group ">
                            <span class="form-error"></span>
                            <div class="col-lg-12 col-lg-offset-2">
                            <input type="submit" name="submit" class="btn btn-secondary" id="submit" value="Valider">
                            </div>
                        </div>
                    </div>
                    <div class="article-return">
                <a href="index.php?route=adminmembers" class="btn btn-info return">Admin</a>
                </div>
                </form>
                
            </div>
        </div>
    </section><!-- End Actuality  Section -->
  