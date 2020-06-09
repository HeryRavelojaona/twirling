
<?php $this->title = "Administration histoire"; ?>
<?php include 'adminNavbar.php';?>
<?php include 'adminNavbar.php';?>
<section id="Story" class="actuality ">
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
                            $title = 'Brouillon';
                            $icon = 'fa-pause-circle';
                            $color= 'secondary';
                        }else if($story->getStatus()== 1){$action = 'Article publié';
                                    $title = 'Publié';
                                    $color= 'primary';
                                    $icon = 'fa-check-square';} 
            ?>

            <tbody>
                <tr>
                    <td><?= htmlspecialchars($story->getTitle());?></td>
                    <td><?= htmlspecialchars($usersName);?></td>
                    <td><?= htmlspecialchars($date->format('d-m-Y'));?></td>
                    <td class="action-table">
                        <a href="index.php?route=article&articleId=<?= htmlspecialchars($story->getId());?>" class="btn btn-info admin-btn" title="voir"><i class="fas fa-eye"></i></a>
                        <a href="index.php?route=updatearticle&articleId=<?= htmlspecialchars($story->getId());?>" class="btn admin-btn btn-warning" title="Modifier"><i class="fas fa-exchange-alt"></i></a>
                        <a href="index.php?route=publishOrNot&articleId=<?= htmlspecialchars($story->getId());?>&action=<?= htmlspecialchars($action);?>" class="btn admin-btn btn-<?= htmlspecialchars($color);?>" title="<?= htmlspecialchars($title);?>"><i class="far <?= htmlspecialchars($icon);?>"></i></a>
                        <a class="btn btn-danger admin-btn check-delete" data-deleteid="delete-article-<?= $story->getId() ?>" title="Supprimer"><i class="fas fa-trash-alt" data-deleteid="delete-article-<?= $story->getId() ?>"></i></a>
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