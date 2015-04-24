<!-- start slider  -->
<div class="rslides_container hidden-xs">
  <ul class="rslides" id="slider2">
   <li><?php echo $this->Html->image("slider/slide1.jpg", array(
    'url' => Router::url('/'),
    'class' => 'img-responsive'
    ));
    ?></li>
    <li><?php echo $this->Html->image("slider/slide2.jpg", array(
      'url' => Router::url('/'),
      'class' => 'img-responsive'
      ));
      ?></li>
      <li><?php echo $this->Html->image("slider/slide3.jpg", array(
        'url' => Router::url('/'),
        'class' => 'img-responsive'
        ));
        ?></li>
      </ul>
    </div>
    <!-- fin slider --> 

    <hr>
    
    <!-- Start nouvelle collection  -->
    <h2 class='text-danger'>Nouveautés</h2>
    
    <br>

    <div class="row"> <!-- ici on mettra les chaussures qui on un 'tag' nouveauté, par exemple  -->


      <?php foreach ($new_chaussures as $new_chaussure) {
        ?>
        <div class="col-md-3">
          <div class="thumbnail text-center">
            <span class="pull-left label label-danger">New</span>

           <?php echo $this->Html->image("Chaussures/" . $new_chaussure['Chaussure']['path'], array(
            'url' => array('controller' => 'chaussures',
                    'action'=> 'produit/'.$new_chaussure['Chaussure']['ref']),
                    'class' => 'img-responsive img-produit'
            ));
            ?> <!-- on affiche l'image de la chaussure -->

            <div class="caption">
              <h3 class=""><?php echo $new_chaussure['Chaussure']['nom']; ?></h3>   <!-- on affiche le titre -->

              <div class="row">
                <div class="col-md-6">
                  <p class="lead"><?php echo $new_chaussure['Chaussure']['prix']; ?> €</p> <!-- on affiche le prix -->
                </div>
                <div class="col-md-6">
                 <?php echo $this->Html->link("Détails", array('controller' => 'chaussures',
                 'action'=> 'produit/'.$new_chaussure['Chaussure']['ref']), array( 'class' => 'btn btn-sm btn-primary')); ?>
               </div>
             </div>
           </div>
         </div>
       </div>
       <?php
     }
     ?>

     

   </div>  
   <!-- fin nouvelle collection  -->

   <!-- Start Top Ventes  -->
   <h2 class='text-primary'>Top Ventes</h2>

   <br>

   <div class="row"> <!-- ici on mettra les chaussures qui on un 'tag' nouveauté, par exemple  -->

    <?php foreach ($hot_chaussures as $hot_chaussure) {
        ?>
        <div class="col-md-3">
          <div class="thumbnail text-center">
            <span class="pull-left label label-info">Top</span>

           <?php echo $this->Html->image("Chaussures/" . $hot_chaussure['Chaussure']['path'], array(
            'url' => array('controller' => 'chaussures',
                    'action'=> 'produit/'.$hot_chaussure['Chaussure']['ref']),
                    'class' => 'img-responsive img-produit'
            ));
            ?> <!-- on affiche l'image de la chaussure -->

            <div class="caption">
              <h3 class=""><?php echo $hot_chaussure['Chaussure']['nom']; ?></h3>   <!-- on affiche le titre -->

              <div class="row">
                <div class="col-md-6">
                  <p class="lead"><?php echo $hot_chaussure['Chaussure']['prix']; ?> €</p> <!-- on affiche le prix -->
                </div>
                <div class="col-md-6">
                 <?php echo $this->Html->link("Détails", array('controller' => 'chaussures',
                 'action'=> 'produit/'.$hot_chaussure['Chaussure']['ref']), array( 'class' => 'btn btn-sm btn-primary')); ?>
               </div>
             </div>
           </div>
         </div>
       </div>
       <?php
     }
     ?>

</div>  
<!-- fin top -->