<ol class="breadcrumb">
	<li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
	<li><a href="<?= Router::url('/'); ?>femmes">Femme</a></li>
	<li class="active"><?php echo $name_souscat[0]['Souscategorie']['nom'];?></li>
</ol>

<div class="row">
	<?php if (isset($chaussure)){ ?>
		
	<?php }else{?>

	<?php }?>

	<?php foreach ($chaussures as $chaussure) {
	?>
		<div class="col-md-3">

			<div class="thumbnail text-center">
				<?php if($chaussure['Chaussure']['date_mise_en_ligne'] >= date('d-m-Y', strtotime("-1 week")))
				{
					echo 'NEW';

				}
				?>

				<?php echo $this->Html->image("Chaussures/" . $chaussure['Chaussure']['path'], array(
					'url' => '/chaussures/produit/' . $chaussure['Chaussure']['ref'],
					'class' => 'img-responsive img-produit'
					)); 
					?>
					<!-- on affiche l'image de la chaussure -->

					<div class="caption">
						<h3 class=""><?php echo $chaussure['Chaussure']['nom']; ?></h3>   <!-- on affiche le titre -->

						<div class="row">
							<div class="col-md-6">
								<p class="lead"><?php echo $chaussure['Chaussure']['prix'] .'€'; ?></p> <!-- on affiche le prix -->
							</div>
							<div class="col-md-6">
								<?php echo $this->Html->link("Détails", array('controller' => 'chaussures','action'=> "produit/" . $chaussure['Chaussure']['ref']), array( 'class' => 'btn btn-sm btn-primary')); ?>
							</div>
						</div>
					</div>
				</div>


			</div>
			<?php } ?>
		</div>

</div>  

<br>

<ol class="breadcrumb">
	<li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
	<li><a href="<?= Router::url('/'); ?>femmes">Femme</a></li>
	<li class="active"><?php echo $name_souscat[0]['Souscategorie']['nom'];?></li>
</ol>