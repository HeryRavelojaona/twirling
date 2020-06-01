
 <?php $this->title = "Ajouter un evenement"; ?>
 <!-- ======= Actuality Section ======= -->
        <section id="Actuality" class="actuality event-edit">
        <div class="container">

            <div class="section-title">
                <span>Planning</span>
                <h2>Planning</h2>
            </div>
            <div class="row">

                <form class="col-lg-12" id="form_event" action="" method="post">
                    <div class="box addarticlebox">

                        <div class="form-group">
                            <label for="title" class="col-lg-6 control-label">Titre ou Jour</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="event_title" name="title"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="place" class="col-lg-6 control-label">Lieu</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="event_place" name="place"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-lg-6 control-label">Adresse</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="event_address" name="address"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start" class="col-lg-6 control-label">Début</label>
                            <div class="col-lg-12">
                                <input type="time" class="form-control" id="event_start" name="start"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end" class="col-lg-6 control-label">Fin</label>
                            <div class="col-lg-12">
                                <input type="time" class="form-control" id="event_end" name="end"  >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-lg-6 control-label">Message</label>
                            <div class="col-lg-12">
                                <textarea class="form-control  tiny" id="event_content" name="content"></textarea>
                            </div>
                        </div>  
                        <div class="form-group">
                            <span class="form-error"></span>
                            <div class="col-lg-12 col-lg-offset-2">
                            <input type="submit" name="submit" class="btn btn-secondary" id="event_submit" value="Visualiser">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="return-btn">
                    <a href="../public/index.php?route=administration" class="btn btn-info ">Retour</a>
                </div>
            </div>
        </div>
    </section><!-- End Actuality  Section -->
   <!-- ======= Training Section ======= -->
   <section id="Training" class="training event-preview">
    <div class="container">

      <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="box">
                    <h3 class="preview-title"></h3>
                    <h4 class="preview-place"></h4>
                    <ul>
                        <li class="preview-address">s</li>
                        <li>De <strong class="training-date preview-start"></strong> à <strong class="training-date preview-end"></strong></li>
                    </ul>
                    <p class="preview-content"></p>
                </div>
            </div>
      </div>
      <form action="index.php?route=addevent"method="post">
            <div class="form-group">    
                    <div class="col-lg-12">
                        <input type="hidden" class="form-control" id="savetitle" name="title" value="">
                    </div>
            </div>
            <div class="form-group">    
                    <div class="col-lg-12">
                        <input type="hidden" class="form-control" id="saveplace" name="place" value="">
                    </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <input type="hidden" class="form-control" id="saveaddress" name="address" value="">
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <input type="hidden" class="form-control" id="savestart" name="start" value="">
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <input type="hidden" class="form-control" id="saveend" name="end" value="">
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
            <a href="../public/index.php?route=administration" class="btn btn-info ">Retour</a>
        </div>

    </div>
  </section>

    <!--Tinymce Wysiwigg-->
     <script src="https://cdn.tiny.cloud/1/x34paag6wieet4xq5hwhj0zakt8qjxa9hpmq1btsb5vzelp8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
