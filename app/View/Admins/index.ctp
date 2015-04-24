<div class="well well-sm">
  <h1 class='text-center'>PANEL ADMIN</h1>
</div>

<br>

<div class="row">
  <div class="text-center">
    <div class="col-md-4">
     <?= $this->Form->create('Admin', array('action' => 'index')); ?>
     <div class="input-group">
      <?= $this->Form->input('Chaussure.ref', array('placeholder' => 'Rechercher une chaussure', 'label' => false, 'class' => 'form-control')); ?>
      <span class="input-group-btn">
        <?= $this->Form->submit("Rechercher", array("class"=>"btn btn-primary text-center")); ?>
      </span>
      <?= $this->Form->end(); ?>
      <!-- </form> -->
    </div>
  </div>
</div>
</div>

<br>

<?php

if(isset($chaussures)) {

  ?>
  <h4> Résultat recherche </h4>

  <h2> <?php if(isset($chaussures['0']['Chaussure']['nom']))
    {
      echo $chaussures['0']['Chaussure']['nom']; 
    }
    elseif (!isset($chaussures['0']['Chaussure']['nom'])) {
      echo "La chaussure n'existe pas";
    }
    ?> </h2>

    <?php
    foreach ($chaussures as $chaussure){
      ?>  
      <?php if(isset($chaussure['Stock']['pointure'])) { ?>
      <form method='POST' action='<?php echo Router::url('/') ?>chaussures/update'>

        <span> Pointure </span>
        <br />
        <?php echo $chaussure['Stock']['pointure']; ?>
        <input type='hidden' name='data[Stock][pointure]' value="<?php echo $chaussure['Stock']['pointure']; ?>"  />
        <input type='hidden' name='data[Chaussure][id]' value="<?php echo $chaussure['Chaussure']['id']; ?>"  /><br />
        <span> Stock </span>
        <br />
        <input name='data[Stock][stock]' value="<?php echo $chaussure['Stock']['stock'] ?>"    />


        <input type='submit' value='Mettre a jour le stock' />
      </form>
      <?php } ?>


      <?php
    }
    ?>

    <?php if(isset($chaussures['0']['Chaussure']['nom']))
    {
      ?>

      <h4> Ajout d'une pointure avec son stock </h4>
      <form method='POST' action='/e-commerce/chaussures/addpointure'>
        <input type='hidden' name='data[Chaussure][id]' value="<?php echo $chaussures['0']['Chaussure']['id']; ?>"  />
        <span>Pointure</span>
        <input type='text' name='data[Stock][pointure]' value=""  />
        <span> Stock </span>
        <input type='text' name='data[Stock][stock]' value=""  />
        <input type='submit' value='Ajouter une pointure + stock' />
      </form>

      <h4> Modification du prix </h4>

      <form method='POST' action='/e-commerce/chaussures/updateprix'>
        <input type='hidden' name='data[Chaussure][id]' value="<?php echo $chaussures['0']['Chaussure']['id']; ?>"  />
        <input type='text' name='data[Chaussure][prix]' value="<?php echo $chaussures['0']['Chaussure']['prix']; ?>"  />
        <input type='submit' value='Mettre à jour son prix' />
      </form>
      <br>

      <form method='POST' action='/e-commerce/chaussures/delete'>
        <input type='hidden' name='data[Chaussure][id]' value="<?php echo $chaussures['0']['Chaussure']['id']; ?>"  />
        <input type='submit' value='Supprimer cette chaussure' />
      </form>

      <?php
    }
  }
  ?>

  <br>

  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            Ajouter un nouveau produit
          </a>
        </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse">
        <div class="panel-body">

          <?php echo $this->Form->create('Chaussure', array('action' => 'addshoes','type' => 'file')); ?>

          <?php echo $this->Form->hidden('Stock.chaussure_id'); ?>

          <?php echo $this->Form->hidden('Chaussure.date_mise_en_ligne'); ?>

          <?php echo $this->Form->input('Chaussure.ref'); ?>

          <?php echo $this->Form->input('Chaussure.nom', array('placeholder' => 'Marque . Model')); ?>

          <div class="input">

           <label for="ChaussureCategorie">Catégorie</label>

           <select name="data[Chaussure][categorie]" id="ChaussureCategorie">

             <option value="">choisissez</option>

             <option value="Femme">Femme</option>

             <option value="Homme">Homme</option>

             <option value="Enfant">Enfant</option>

           </select>

         </div>

         <?php
         echo $this->Form->input('Chaussure.souscategorie_id', array(
           'type'    => 'select',
           'options' => $select_souscat,
           'empty'   => false
           ));
           ?>

           <?php 
           echo $this->Form->input('Chaussure.marque_id', array(
             'type'    => 'select',
             'options' => $select_marque,
             'empty'   => false
             ));
             ?>

             <?php echo $this->Form->input('Chaussure.content', array('placeholder' => 'Description')); ?>
             <?php echo $this->Form->input('Chaussure.couleur'); ?>
             <?php echo $this->Form->input('Chaussure.matiere'); ?>
             <?php echo $this->Form->input('Chaussure.poids'); ?>
             <?php echo $this->Form->input('Chaussure.prix'); ?>

             <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />

             <?php echo $this->Form->input('Path', array('type' => 'file')); ?>
             <?php echo $this->Form->End('add chaussure'); ?>

           </div>
         </div>
       </div>
     </div>


    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseChaussures">
            Afficher toutes les chaussures
          </a>
        </h4>
      </div>
      <div id="collapseChaussures" class="panel-collapse collapse">
        <div class="panel-body">
                  <?php foreach ($all_chaussures as $all_chaussure){
            ?>
            <?php echo 'Reference: ' .$all_chaussure['Chaussure']['ref']; ?>
            <br>
            <?php echo 'Nom: ' .$all_chaussure['Chaussure']['nom']; ?>
            <br>
            <?php echo 'Catégorie: ' .$all_chaussure['Chaussure']['categorie']; ?>
            <br>
            <?php echo 'Prix: ' .$all_chaussure['Chaussure']['prix'] . '€'; ?>
            
            <hr />

            <?php
          }
          ?> 
          </div>
        </div>
    </div>

     <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
            Sous-catégories
          </a>
        </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-6">
              <h4> Creation sous catégorie </h4>
              <?php echo $this->Form->create('Admin', array('action' => 'addsouscategorie')); ?>
              <?php echo $this->Form->input('nom'); ?>
              <?php echo $this->Form->End('crée la sous-catégorie'); ?>
            </div>
            <div class="col-md-6">
              <h4> Liste sous-catégories </h4>
              <?php foreach ($souscategories as $souscategorie)
              {
                ?>
                <h5> <?php echo $souscategorie['Souscategorie']['nom']; ?> </h5>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
              Gestion des utilisateurs
            </a>
          </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
          <div class="panel-body">
           <?php foreach ($users as $user){
            ?>

            <?php echo $user['User']['nom']; ?>
            <br>
            <?php echo $user['User']['prenom']; ?>
            <br>
            <?php echo $user['User']['email']; ?>
            <?php echo $this->Form->create('Admin', array('action' => 'deleteuser')); ?>
            <input type='hidden' name='data[User][id]' value="<?php echo $user['User']['id']; ?>"  />
            <?php echo $this->Form->End('Supprimer ce user'); ?>
            <?php 
            if($user['User']['rank'] == 0)
            {
              ?>
              <?php echo $this->Form->create('Admin', array('action' => 'BeAdmin')); ?>
              <input type='hidden' name='data[User][id]' value="<?php echo $user['User']['id']; ?>"  />
              <?php echo $this->Form->End('Mettre au rang Admin'); ?>

              <?php
            }
            ?>
            <hr />

            <?php
          }
          ?> 

        </div>
      </div>
    </div>
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
            Gestion des marques
          </a>
        </h4>
      </div>
      <div id="collapseFour" class="panel-collapse collapse">
        <div class="panel-body">
         <div class="row">
           <div class="col-md-6">
             <h4> Creation Marque </h4>
             <?php echo $this->Form->create('Admin', array('action' => 'addmarque')); ?>
             <?php echo $this->Form->input('Marque.nom'); ?>

             <h5> Données du fournisseur </h5>

             <?php echo $this->Form->input('Fournisseur.nom'); ?>
             <?php echo $this->Form->input('Fournisseur.telephone'); ?>
             <?php echo $this->Form->input('Fournisseur.adresse'); ?>
             <?php echo $this->Form->input('Fournisseur.nom_responsable'); ?>
             <?php echo $this->Form->End('crée la marque avec son fournisseur'); ?> 
           </div>
           <div class="col-md-6">

            <h4> Liste Marques </h4>
            <?php foreach ($marques as $marque){
              ?>
              <h5> <?php echo $marque['Marque']['nom']; ?> </h5>
              <hr>
              <?php
            }
            ?> 
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseCommandes">
            Afficher toutes les commandes en cours
          </a>
        </h4>
      </div>
      <div id="collapseCommandes" class="panel-collapse collapse">
        <div class="panel-body">
            <?php foreach ($commandes as $commande){
              foreach ($users_cmd as $user_cmd) {
              ?>
              <h5> <?php if($commande['Commande']['user_id'] == $user_cmd['User']['id']) 
                    {
                      echo 'Nom utilisateur: ' . $user_cmd['User']['nom'] . '<br>';
                      echo 'Prenom utilisateur: ' . $user_cmd['User']['prenom'] . '<br>';
                      echo 'Date de commande: ' . $commande['Commande']['date_commande'] . '<br>';
                      echo 'Date de livraison: ' . $commande['Commande']['date_livraison'];
                 ?>   

          <form method='POST' action='<?php echo Router::url('/') ?>commandes/updateadmin'>
        <input type='hidden' name='data[Commande][id]' value="<?php echo $commandes['0']['Commande']['id']; ?>"  />
        <input type='submit' value='Definir comme livré' />
      </form>



            <?php
                    }
                  }

              ?> 
            </h5>
              
              <?php
               }
            
            ?>
          </div>
        </div>
    </div>
    </div>

  <?php echo $this->Session->flash(); ?>