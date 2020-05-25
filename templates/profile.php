<?php $this->title = "Profil"; ?>

        <section class="container profile">
            <div class="row">
                    <div class="profile-part col-xl-6">
                    <img src="../public/assets/img/hoby.png" class="profil-img img-fluid rounded-circle "><br/>Photo</li>
                        <h3 class="profile-content">Nom: <?= $this->session->get('lastname') ; ?></h3>
                        <h4 class="profile-content">Prénom: <?= $this->session->get('firstname'); ?></h4>
                        <p class="profile-content">Email: <?= $this->session->get('mail'); ?></p>
                        <p class="profile-content">Role: <?= $this->session->get('role'); ?></p>
                    </div>    
                    <div class="profile-part col-xl-6 ">
                        <a href="../public/index.php?route=updatePassword" class="btn btn-warning profile-content">Modifier votre mot de passe</a><br/>
                        <div class="control-delete">
                            <button class="check-delete btn-danger">Supprimer votre compte</button>
                            <p class="go-delete">Etes vous sur ?</p>
                            <a href="../public/index.php?route=deleteAccount" class="go-delete btn btn-warning">Oui</a>
                            <button class="go-delete stop-delete btn btn-secondary">Non</button>
                        </div>
                    </div>
            </div>  
            <a href="../public/index.php" class="btn btn-info profile-content">Retour</a>
        </section>
    