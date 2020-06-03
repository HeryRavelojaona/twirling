 <!-- ======= Training Section ======= -->
 <?php $this->title = "Mis à jour d'évènement"; ?>
<section id="Training" class="training ">
<div class="container">
<div class="section-title">
                <span>Planning</span>
                <h2>Planning</h2>
            </div>
    <div class="row">
        <div class="box col-lg-12 admin-update">
            <form  id="update_event" method="post" action="index.php?route=updateevent&eventId=<?= htmlspecialchars($event->getId());?>">
                <div class="form-group">
                    <label for="title">Titre</label><br/>
                    <input type="text" name="title" value="<?= htmlspecialchars($event->getTitle());?>">
                </div>
                <div class="form-group">
                    <label for="title">Lieu</label>
                    <input type="text" class="col-lg-12" name="place" value="<?= htmlspecialchars($event->getPlace());?>">
                </div>
                <ul class="form-group">
              
                    <label for="title">Adresse</label>
                     <li class="col-lg-12"><input  class="col-lg-12" type="text" name="address" value="<?= htmlspecialchars($event->getAddress());?>"></li>
                     <label for="hours">Horaires</label>
                    <li>De <input type="time" name="start" value="<?= htmlspecialchars($event->getDateStart());?>"> à <input type="time" name="end" value="<?= htmlspecialchars($event->getDateEnd());?>"></li>
                </ul>
          
                <div class="form-group">
                    <label for="content">Commentaire</label>
                     <input type="text" class="col-lg-12" name="content" value="<?= isset($event)? htmlspecialchars($event->getComment()):'';?>">
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
            </form>
            </div>
        </div>
    </div>
</section>