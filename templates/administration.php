<?php $this->title = "Administration"; ?>
<?php include 'adminNavbar.php';?>
<main id="main">
        <!-- ======= Actuality Section ======= -->
        
    <section id="Actuality" class="actuality ">
        <div class="container">
            <div class="section-title">
                <h2>Publications</h2>
                <?= $this->session->show('addarticle'); ?>
                <?= $this->session->show('updatearticle'); ?>
                <?= $this->session->show('status_article'); ?>
                <?= $this->session->show('delete_article'); ?>
            </div>
            <div class="message-for-all">
                <a href="../public/index.php?route=addarticle" class="btn btn-primary text-message-for-all">Ajouter une nouvelle actualité <i class="fas fa-plus-circle"></i></a>
            </div>
        <div >
        <table class="table container admin-table admin-reload">
           
            <thead class="thead-style">
                <tr>
                <th>TITRE</th>
                <th>Créé par</th>
                <th>Créé le</th>
                <th>Actions</th>
                </tr>
            </thead>
            <?php
                    foreach ($articles as $article)
                    {   $date = new Datetime($article->getCreatedAt());
                        if($article->getStatus()== 0){$action = 'Brouillon';
                            $title = 'Brouillon';
                            $color= 'secondary';
                            $icon = 'fa-pause-circle';
                        }else if($article->getStatus()== 1){$action = 'Article publié';
                                    $icon = 'fa-check-square';
                                    $title = 'Publié';
                                    $color= 'primary';
                        } 
            ?>

            <tbody>
                <tr>
                    <td><?= htmlspecialchars($article->getTitle());?></td>
                    <td><?= htmlspecialchars($usersName);?></td>
                    <td><?= htmlspecialchars($date->format('d-m-Y'));?></td>
                    <td class="action-table">
                        <a href="index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>" class="btn btn-info admin-btn" title="voir"><i class="fas fa-eye"></i></a>
                        <a href="index.php?route=updatearticle&articleId=<?= htmlspecialchars($article->getId());?>" class="btn admin-btn btn-warning" title="Modifier"><i class="fas fa-exchange-alt"></i></a>
                        <a href="index.php?route=publishOrNot&articleId=<?= htmlspecialchars($article->getId());?>&action=<?= htmlspecialchars($action);?>" class="btn admin-btn btn-<?= htmlspecialchars($color);?>" title="<?= htmlspecialchars($title);?>"><i class="far <?= htmlspecialchars($icon);?>"></i></a>
                        <a class="btn btn-danger admin-btn check-delete" data-deleteid="delete-article-<?= $article->getId() ?>" title="Supprimer"><i class="fas fa-trash-alt" data-deleteid="delete-article-<?= $article->getId() ?>"></i></a>
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
