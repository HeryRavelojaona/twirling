
<?php $this->title = "Ajouter un article"; ?>
<?php include 'adminNavbar.php';?>
 <!-- ======= Actuality Section ======= -->
        <section id="Actuality" class="actuality actuality-edit">
        <div class="container">

            <div class="section-title">
                <span>Publications</span>
                <h2>Publications</h2>
            </div>
            <div class="row">

                <form class="col-lg-12" id="form_article" action="" method="post" enctype="multipart/form-data">
                    <div class="box addarticlebox">
                        <div class="form-group ">
                            <label>Choisir la catégorie</label>
                            <div class="col-lg-12">
                                <select name="category" class="category-choice">
                                    <option value="actuality" class="option">Actualité</option>
                                    <option value="story" class="option">Histoire du club</option>
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
                            <label for="title" class="col-lg-6 control-label">Titre</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="actualityTitle" name="title"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-lg-6 control-label">Texte</label>
                            <div class="col-lg-12">
                                <textarea class="form-control  tiny" id="actualityContent" name="content"></textarea>
                            </div>
                        </div>  
                        <div class="form-group ">
                            <span class="form-error"></span>
                            <div class="col-lg-12 col-lg-offset-2">
                            <input type="submit" name="submit" class="btn btn-secondary" id="submit" value="Visualiser">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="return-btn">
                    <a href="index.php?route=administration" class="btn btn-info ">Retour</a>
                </div>
            </div>
        </div>
    </section><!-- End Actuality  Section -->
             <!-- ======= Actuality Section ======= -->
    <section id="Actuality" class="actuality preview" >
          <div class="container actuality preview">
          
            <div class="section-title">
                <h2>Aperçu</h2>
            </div>
            
            <div class="row">
              <div class="col-lg-12">
                <div class="box article-box">
                  <img src="" class="actuality-img" id="preview_file">
                  <span class="actuality-date">01/02/2020</span>
                  <h4 class="preview-title"></h4>
                  <p class="preview-content"></p>
                </div>
              </div>
            </div>
            <form action="index.php?route=addarticle"method="post" >
                <div class="form-group">    
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="savechoice" name="choice" value="">
                        </div>
                </div>
                <div class="form-group">    
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="savefilename" name="filename" value="">
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <input type="hidden" class="form-control" id="savetitle" name="title" value="">
                </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <textarea class="form-control" id="savecontent" name="content"></textarea>
                    </div>
                </div>   
                <div class="action"> 
                    <div class="form-group ">
                        <div class="col-lg-6 col-lg-offset-2">
                        <input type="submit" name="submit" class="btn btn-primary" id="submit" value="Publier">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-lg-6 col-lg-offset-2 ">
                        <input type="submit" name="save" class="btn btn-info" id="save" value="Enregistrer">
                        </div>
                    </div>
                </div>
            </form>
                <div class="return-btn">
                    <a href="index.php?route=addarticle" class="btn btn-info ">Annuler</a>
                </div>
          </div>
    </section><!-- End Actuality  Section -->

  