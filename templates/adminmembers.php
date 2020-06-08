<?php include 'adminNavbar.php';?>
<section id="Members" class="actuality ">
        <div class="container">
            <div class="section-title">
                <h2>Membres du bureau</h2>
                <?= $this->session->show('delete_user'); ?>
                <?= $this->session->show('send_message'); ?>
                <?= $this->session->show('user_message'); ?>
                <div class="message-for-all">
                    <a href="index.php?route=contactmembers" class="btn btn-secondary text-message-for-all">Envoyer un message collectif <i class="fas fa-envelope-square"></i></a><br/>
                    <span class="response-message"></span>
                </div>
            </div>
           
            <div class="message-for-all">
                <a href="index.php?route=adduser" class="btn btn-primary text-message-for-all">Ajouter un membre <i class="fas fa-plus-circle"></i></a>
            </div>
        <div >
        <table class="table container admin-table admin-reload">
           
            <thead class="thead-style">
                <tr>
                <th>Nom/Prénom</th>
                <th>Rôle</th>
                <th>Actions</th>
                </tr>
            </thead>
            <?php
                    foreach ($allUsers as $AllUser)
                    { 
                        if($AllUser->getVisible()== 0){$action = "Non visible";
                            $color= 'secondary';
                            $icon = 'fa-pause-circle';
                        }else if($AllUser->getVisible()== 1){$action = 'Visible';
                            $icon = 'fa-check-square';
                            $color= 'primary';} 
            ?>

            <tbody>
                <tr>
                    <td><?= htmlspecialchars($AllUser->getLastName());?><br/><?= htmlspecialchars($AllUser->getFirstName());?> </td>
                    <td><?= htmlspecialchars($AllUser->getRole());?></td>
                    <td class="action-table">
                        <a href="index.php?route=contactuser&userId=<?= htmlspecialchars($AllUser->getId());?>" class="btn btn-info admin-btn">Contacter</a>
                        <?php if($this->session->get('id')== htmlspecialchars($AllUser->getId()))
                        {;?>
                         <a href="index.php?route=profile" class="btn admin-btn btn-warning">Profil</a>
                        <?php 
                        };?>
                        <a href="index.php?route=publishOrNot&userId=<?= htmlspecialchars($AllUser->getId());?>&action=<?= htmlspecialchars($action);?>" class="btn admin-btn btn-<?= htmlspecialchars($color);?>"><?= htmlspecialchars($action);?> </a>
                    </td>
                </tr>
            </tbody>
            <?php
            }
            ?>
            </table>

</section><!-- End Actuality Section -->

<section id="Adherents" class="actuality ">
        <div class="container">
            <div class="section-title">
                <h2>Adhérents</h2>
            </div>
            <div class="message-for-all">
                <a href="../public/index.php?route=adduser" class="btn btn-primary text-message-for-all">Ajouter un membre <i class="fas fa-plus-circle"></i></a>
            </div>
        <div >
        <table class="table container admin-table admin-reload">
           
            <thead class="thead-style">
                <tr>
                <th>Nom/Prénom</th>
                <th>Rôle</th>
                <th>Actions</th>
                </tr>
            </thead>
            <?php
                    foreach ($members as $member)
                    {          
            ?>

            <tbody>
                <tr>
                    <td><?= htmlspecialchars($member->getLastName());?><br/><?= htmlspecialchars($member->getFirstName());?> </td>
                    <td><?= htmlspecialchars($member->getRole());?></td>
                    <td class="action-table">
                        <a href="index.php?route=contactuser&userId=<?= htmlspecialchars($member->getId());?>" class="btn btn-info admin-btn">Contacter</a>
                        <a class="btn btn-danger admin-btn check-delete" data-deleteid="delete-article-<?= $member->getId() ?>">Supprimer</a>
                        <div class="control-delete" id="delete-article-<?= $member->getId() ?>">
                            <form action="index.php?route=deleteuser" method="POST" class="delete-form" >
                            <p class="go-delete">Etes vous sur ?</p>
                                <input type="hidden" name="userId" id="sendUserId" value="<?= htmlspecialchars($member->getId());?>"/>
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