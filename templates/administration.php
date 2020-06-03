<?php $this->title = "Administration"; ?>
<main id="main">
    <div class="message-for-all">
        <a class="btn btn-secondary text-message-for-all">Envoyer un message collectif <i class="fas fa-envelope-square"></i></a><br/>
        <span class="response-message"></span>
    </div>
        <!-- ======= Actuality Section ======= -->
        
    <section id="Actuality" class="actuality ">
        <div class="container">
            <div class="section-title">
                <h2>Publications</h2>
                <?= $this->session->show('addarticle'); ?>
                <?= $this->session->show('status_event'); ?>
                <?= $this->session->show('updatearticle'); ?>
                <?= $this->session->show('status_article'); ?>
                <?= $this->session->show('delete_article'); ?>
                <?= $this->session->show('addevent'); ?>
                <?= $this->session->show('delete_event'); ?>
                <?= $this->session->show('updateevent'); ?>
            </div>
            <div class="message-for-all">
                <a href="../public/index.php?route=addarticle" class="btn btn-primary text-message-for-all">Ajouter une nouvelle actualité <i class="fas fa-plus-circle"></i></a>
            </div>
        <div >
        <table class="table container admin-table admin-reload">
           
            <thead class="thead-style">
                <tr>
                <th>TITRE</th>
                <th>Crée par</th>
                <th>Crée le</th>
                <th>Actions</th>
                </tr>
            </thead>
            <?php
                    foreach ($articles as $article)
                    {   $date = new Datetime($article->getCreatedAt());
                        if($article->getStatus()== 0){$action = 'Brouillon';
                            $status = 'Brouillon';
                            $color= 'secondary';
                        }else if($article->getStatus()== 1){$action = 'Article publié';
                                    $status = 'Publié';
                                     $color= 'primary';} 
            ?>

            <tbody>
                <tr>
                    <td><?= htmlspecialchars($article->getTitle());?></td>
                    <td><?= htmlspecialchars($usersName);?></td>
                    <td><?= htmlspecialchars($date->format('d-m-Y'));?></td>
                    <td class="action-table">
                        <a href="index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>" class="btn btn-info admin-btn">Voir</a>
                        <a href="index.php?route=updatearticle&articleId=<?= htmlspecialchars($article->getId());?>" class="btn admin-btn btn-warning">Modifier</a>
                        <a href="index.php?route=publishOrNot&articleId=<?= htmlspecialchars($article->getId());?>&action=<?= htmlspecialchars($action);?>" class="btn admin-btn btn-<?= htmlspecialchars($color);?>"><?= htmlspecialchars($action);?> </a>
                        <a class="btn btn-danger admin-btn check-delete" data-deleteid="delete-article-<?= $article->getId() ?>">Supprimer</a>
                        <div class="control-delete" id="delete-article-<?= $article->getId() ?>">
                            <form action="index.php?route=deletearticle" method="POST" class="delete-form" >
                            <p class="go-delete">Etes vous sur ?</p>
                                <input type="hidden" name="articleId" id="sendArticleId" value="<?= htmlspecialchars($article->getId());?>"/>
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

<!---Training-part--->
<section id="Training" class="actuality">
        <div class="container">
            <div class="section-title">
                <h2>Entrainements</h2>
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
                            $status = 'Brouillon';
                            $color= 'secondary';
                        }else if($event->getStatus()== 1){$action = 'Article publié';
                                    $status = 'Publié';
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
                        <a href="index.php?route=event&eventId=<?= htmlspecialchars($event->getId());?>" class="btn btn-info admin-btn">Voir</a>
                        <a href="index.php?route=updateevent&eventId=<?= htmlspecialchars($event->getId());?>" class="btn admin-btn btn-warning">Modifier</a>
                        <a href="index.php?route=publishOrNot&eventId=<?= htmlspecialchars($event->getId());?>&action=<?= htmlspecialchars($action);?>" class="btn admin-btn btn-<?= htmlspecialchars($color);?>"><?= htmlspecialchars($action);?> </a>
                        <a class="btn btn-danger admin-btn check-delete" data-deleteid="delete-event-<?= $event->getId() ?>">Supprimer</a>
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

<section id="Actuality" class="actuality ">
        <div class="container">
            <div class="section-title">
                <h2>Histoire du club</h2>
            </div>
            <div class="message-for-all">
            </div>
        <div >
        <table class="table container admin-table admin-reload">
           
            <thead class="thead-style">
                <tr>
                <th>TITRE</th>
                <th>Crée par</th>
                <th>Crée le</th>
                <th>Actions</th>
                </tr>
            </thead>
            <?php
                    foreach ($stories as $story)
                    {   $date = new Datetime($story->getCreatedAt());
                        if($story->getStatus()== 0){$action = 'Brouillon';
                            $status = 'Brouillon';
                            $color= 'secondary';
                        }else if($story->getStatus()== 1){$action = 'Article publié';
                                    $status = 'Publié';
                                     $color= 'primary';} 
            ?>

            <tbody>
                <tr>
                    <td><?= htmlspecialchars($story->getTitle());?></td>
                    <td><?= htmlspecialchars($usersName);?></td>
                    <td><?= htmlspecialchars($date->format('d-m-Y'));?></td>
                    <td class="action-table">
                        <a href="index.php?route=article&articleId=<?= htmlspecialchars($story->getId());?>" class="btn btn-info admin-btn">Voir</a>
                        <a href="index.php?route=updatearticle&articleId=<?= htmlspecialchars($story->getId());?>" class="btn admin-btn btn-warning">Modifier</a>
                        <a href="index.php?route=publishOrNot&articleId=<?= htmlspecialchars($story->getId());?>&action=<?= htmlspecialchars($action);?>" class="btn admin-btn btn-<?= htmlspecialchars($color);?>"><?= htmlspecialchars($action);?> </a>
                        <a class="btn btn-danger admin-btn check-delete" data-deleteid="delete-article-<?= $story->getId() ?>">Supprimer</a>
                        <div class="control-delete" id="delete-article-<?= $story->getId() ?>">
                            <form action="index.php?route=deletearticle" method="POST" class="delete-form" >
                            <p class="go-delete">Etes vous sur ?</p>
                                <input type="hidden" name="articleId" id="sendArticleId" value="<?= htmlspecialchars($story->getId());?>"/>
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





    