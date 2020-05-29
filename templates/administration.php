<?php $this->title = "Administration"; ?>
<main id="main">
    <div class="message-for-all">
        <a class="btn btn-secondary text-message-for-all">Envoyer un message collectif <i class="fas fa-envelope-square"></i></a><br/>
        <span class="response-message"></span>
    </div>
        <!-- ======= Actuality Section ======= -->
        
    <section id="Actuality" class="actuality admin-reload">
        <div class="container">
            <div class="section-title">
                <h2>Publications</h2>
                <?= $this->session->show('addarticle'); ?>
                <?= $this->session->show('updatearticle'); ?>
            </div>
            <div class="message-for-all">
                <a href="../public/index.php?route=addarticle" class="btn btn-primary text-message-for-all">Ajouter une nouvelle actualité <i class="fas fa-plus-circle"></i></a>
            </div>
        <div >
        <table class="table container admin-table">
           
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
                        <a href="index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>" class="btn btn-info">Voir</a>
                        <a href="index.php?route=updatearticle&articleId=<?= htmlspecialchars($article->getId());?>" class="btn btn-warning">Modifier</a>
                        <a href="index.php?route=publishOrnot&articleId=<?= htmlspecialchars($article->getId());?>&action=<?= htmlspecialchars($action);?>" class="btn btn-<?= htmlspecialchars($color);?>"><?= htmlspecialchars($action);?> </a>
                        <a class="btn btn-danger check-delete">Supprimer</a>
                        <div class="control-delete">
                            <p class="go-delete">Etes vous sur ?</p>
                            <form action="" method="GET">
                                <input type="hidden" name="articleId" id="sendArticleId" value="<?= htmlspecialchars($article->getId());?>"/>
                                <button class="btn btn-danger go-delete confirm-delete">Oui <i class="fas fa-trash-alt"></i></button>
                            </form>
                            <button class="stop-delete go-delete btn btn-secondary">Non</button>
                        </div>
                    </td>
                </tr>
            </tbody>
            <?php
            }
            ?>
            </table>

</section><!-- End Actuality Section -->




    