<!---Training-part--->
<?php include 'adminNavbar.php';?>
<section id="Training" class="actuality">
        <div class="container">
            <div class="section-title">
                <h2>Entrainements</h2>
                <?= $this->session->show('addevent'); ?>
                <?= $this->session->show('delete_event'); ?>
                <?= $this->session->show('updateevent'); ?>
                <?= $this->session->show('status_event'); ?>
            </div>
            <div class="message-for-all">
                <a href="../public/index.php?route=addevent" class="btn btn-primary text-message-for-all">Ajouter un nouvel entrainement <i class="fas fa-plus-circle"></i></a>
            </div>
        <div >
        <table class="table container admin-table admin-reload">
           
            <thead class="thead-style">
                <tr>
                <th>Jour et<br/> heure</th>
                <th>Lieu</th>
                <th>Actions</th>
                </tr>
            </thead>
            <?php
                    foreach ($events as $event)
                    {  
                        if($event->getStatus()== 0){$action = 'Brouillon';
                            $title = 'Brouillon';
                            $icon = 'fa-pause-circle';
                            $color= 'secondary';
                        }else if($event->getStatus()== 1){$action = 'Article publié';
                                $title = 'Publié';
                                $icon = 'fa-check-square';
                                $color= 'primary';} 
            ?>

            <tbody>
                <tr>
                    <td><?= htmlspecialchars($event->getTitle());?><br/>
                        <?= htmlspecialchars(substr($event->getDateStart(), 0,5));?><br/>
                        <?= htmlspecialchars(substr($event->getDateEnd(), 0,5));?>
                    </td>
                    <td><?= htmlspecialchars($event->getPlace());?></td>
                    <td class="action-table">
                        <a href="index.php?route=event&eventId=<?= htmlspecialchars($event->getId());?>" class="btn btn-info admin-btn" title="voir"><i class="fas fa-eye"></i></a>
                        <a href="index.php?route=updateevent&eventId=<?= htmlspecialchars($event->getId());?>" class="btn admin-btn btn-warning" title="Modifier"><i class="fas fa-exchange-alt"></i></a>
                        <a href="index.php?route=publishOrNot&eventId=<?= htmlspecialchars($event->getId());?>&action=<?= htmlspecialchars($action);?>" class="btn admin-btn btn-<?= htmlspecialchars($color);?>" title="<?= htmlspecialchars($title);?>"><i class="far <?= htmlspecialchars($icon);?>"></i></a>
                        <a class="btn btn-danger admin-btn check-delete" data-deleteid="delete-event-<?= $event->getId() ?>" title="Supprimer"><i class="fas fa-trash-alt" data-deleteid="delete-article-<?= $event->getId() ?>"></i></a>
                        <div class="control-delete" id="delete-event-<?= $event->getId() ?>">
                            <form action="index.php?route=deleteevent" method="POST" class="delete-form" >
                            <p class="go-delete">Etes vous sur ?</p>
                                <input type="hidden" name="eventId" id="sendEventId" value="<?= htmlspecialchars($event->getId());?>"/>
                                <button class="btn btn-danger go-delete confirm-delete" name="submit">Oui <i class="fas fa-trash-alt"></i></button>
                                <button class="stop-delete go-delete btn btn-secondary">Non</button>
                            </form>
                            
                        </div>
                    </td>
                </tr>
            </tbody>
            <?php
            }
            ?>
            </table>

</section><!-- End Actuality Section -->
