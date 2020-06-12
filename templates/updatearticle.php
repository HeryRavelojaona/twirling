
<?php $this->title = "Mis à jour article"; ?>
<?php include 'adminNavbar.php';?>
 <!-- ======= Actuality Section ======= -->
        <section id="Actuality" class="actuality actuality-edit">
        <div class="container">

            <div class="section-title">
                <span>Actualités</span>
                <h2>Actualités</h2>
            </div>
            <div class="row">
            <div class="box addarticlebox col-xl-12">
                        <button type="button" id="openModal">
                                <div id="picture_profil">
                                    <img src="assets/img/upload/<?= htmlspecialchars($article->getFileName());?>" class="profil-img img-fluid  " ><br/>Changer de photo 
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
                                <input type="hidden" name="articleId" class="btn btn-info" value="<?= htmlspecialchars($article->getId());?>">
                                <div class="form-group ">
                                    <div class="col-lg-12 col-lg-offset-2 button-submit">
                                        <input type="submit" name="submit" class="btn btn-info" value="Changer">
                                    </div>
                                    <div class="status"></div>
                                </div>
                                <button type="button" class="changeImgClose">close</button>
                            </form>
                        </div>
                <form class="col-lg-12" action="index.php?route=updatearticle&articleId=<?= htmlspecialchars($article->getId());?>" method="post">
                        <div class="form-group">
                            <label for="title" class="col-lg-6 control-label">Titre</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="actualityTitle" name="title" value=" <?= htmlspecialchars($article->getTitle());?>">
                                <div><?= isset($errors['title'])?$errors['title']:'';?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-lg-6 control-label">Texte</label>
                            <div class="col-lg-12">
                                <textarea class="form-control  tiny" id="actualityContent" name="content"><?= $article->getContent();?></textarea>
                                <div><?= isset($errors['content'])?$errors['content']:'';?></div>
                            </div>
                        </div>  
                        <span class="form-error"></span>
                        <div class="action"> 
                            <div class="form-group ">
                                <div class="col-lg-6 col-lg-offset-2">
                                <input type="submit" name="submit" class="btn btn-primary" value="Publier">
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-lg-6 col-lg-offset-2 ">
                                <input type="submit" name="save" class="btn btn-info" value="Enregistrer">
                                </div>
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
  