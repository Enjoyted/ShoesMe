<?php
  if(isset($result_search))
  {
    if(count($result_search) < 1)
    {?>
    <br>
     <h2 class='text-center text-danger'>Oppps, aucune chaussure a été trouvé !</h2>
     <br>
    <?php } 
    else
    { ?>
    <h4>Voici les résultats de votre recherche : </h4>
    <br>
    <div class="row">
      <div class="col-md-3">
        <div class="thumbnail text-center">

           <?php echo $this->Html->image("Chaussures/" . $result_search[0]['Chaussure']['path'], array(
            'url' => '/',
            'class' => 'img-responsive img-produit'
            ));
            ?> <!-- on affiche l'image de la chaussure -->

            <div class="caption">
              <h3 class=""><?php echo $result_search[0]['Chaussure']['nom']; ?></h3>   <!-- on affiche le titre -->

              <div class="row">
                <div class="col-md-6">
                  <p class="lead"><?php echo $result_search[0]['Chaussure']['prix']; ?> €</p> <!-- on affiche le prix -->
                </div>
                <div class="col-md-6">
                 <?php echo $this->Html->link("Détails", array('controller' => 'chaussures','action'=> "produit/" . $result_search[0]['Chaussure']['ref']), array( 'class' => 'btn btn-sm btn-primary')); ?>
               </div>
             </div>
           </div>
         </div>
      </div>
    </div>
  <?php } ?>
  <?php } 
      else 
    {?>
     <br>
     <h2 class='text-center text-danger'>Arretez de bidouiller avec la recherche !</h2>
    <br>
<?php
    };
?> 