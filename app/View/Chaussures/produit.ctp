<div class="row product-info">
	<div class="col-sm-6 col-md-6">
		<!-- start gallerie image  -->
		<div class="image text-center">
		<img id="zoom_mw" class='img-chaussure text-center' src="<?php echo $this->webroot.'/img/Chaussures/' . $chaussures[0]['Chaussure']['path'];?>" data-zoom-image="<?php echo $this->webroot.'/img/Chaussures/' . $chaussures[0]['Chaussure']['path'];?>"/>
	    </a></div>
	    <!--
			modifier juste le src et le lien de data-zomm-image pour les nouvelles images, zoom avec scroll .
	     -->
		<!-- fin gallerie image  -->
	</div>

	<div class="col-sm-6 col-md-6">
		<h1>
		<br /> 
			<strong><?php echo $chaussures[0]['Chaussure']['nom']; ?></strong></h1>
		<div class="line"></div>
		<ul>
			<li><span>Référence:</span> <?php echo $chaussures[0]['Chaussure']['ref']; ?></li>
			<li><span>Couleur:</span> <?php echo $chaussures[0]['Chaussure']['couleur']; ?></li>
			<li><span>Matière:</span> <?php echo $chaussures[0]['Chaussure']['matiere']; ?></li>
		</ul>
		<div class="price">
			Prix :<span class="strike"></span> <strong><?php echo $chaussures[0]['Chaussure']['prix'].'€' ?></strong>
		</div>
		
		<!-- <div class="form-group">
			<label class="control-label">Couleur<span class="required">*</span></label>
			<div class="controls">
				<select>
					<option>Choisir ...</option>
					<option>Blue</option>
					<option>Rouge</option>
					<option>Noir</option>
				</select>
			</div>
		</div> --> <!-- option de choisir les couleur, par exemple -->
		<?php echo $this->Form->create('Panier', array('action' => 'addToPanier/' . $chaussures[0]['Chaussure']['ref'])); ?> 
		<div class="form-group">
			Pointures disponible :
			  <?php echo $this->Form->input('pointure', array(
			 'label'   => false,
			 'type'    => 'select',
			 'default'	=> $select,
			 'options' => $select,
			 'empty'   => false
			 ));
			?>
		</div>
		<div class="line"></div>
			<b>Quantité:</b> <?php echo $this->Form->input('quantity', array(
				'type' => 'number',
				'label' => false,
				'value' => '1',
				'min' => '1',
				'max' => '6',
				'empty' => false,
				'options' => array(
					'class' => 'span1 form-control'
					)
			)); ?> 
			<!-- Hugo, jai mis cette div avec ce style degeulasse pour que le bouton Ajouter au panier
				soit plus presentable, car il se mettait a la ligne. Libre a toi de changer. -->
			<div style="margin-left:250px">
				<?php
					echo $this->Form->submit('Ajouter à mon panier', array(
						'class' => 'btn btn-sm btn-primary'
						)
					);
					echo $this->Form->end(); 
				?>
			<!-- <?php echo $this->Html->link("Ajouter à mon panier", array('controller' => 'panier','action' => 'addToPanier', $chaussures[0]['Chaussure']['ref']), array( 'class' => 'btn btn-sm btn-primary')); ?> -->
			</div>
		<br>
		<div class="tabs">
			<ul class="nav nav-tabs" id="myTab">
				<li class="active"><a href="#description">Description</a></li>
				<li><a href="#avis">Avis</a></li>
			</ul>
			<br>
			<div class="tab-content">
				<div class="tab-pane active" id="description"> <!-- ici on mettra la description de la chaussure -->
					<?php echo $chaussures[0]['Chaussure']['content']; ?>
				</div>
				<div class="tab-pane" id="avis">
				<!-- ici on affiche les commentaires et le formulaire pour que l'utilisateur laisse son commentaire aussi -->
					
					<?php  echo  $this->Form->create();?>
					<?= $this->Form->input('email', array('class' => 'form-control', 'label' => false, 'placeholder' => 'Votre email', 'required' => true));?>
					<br>
					<?= $this->Form->input('nom', array('class' => 'form-control', 'label' => false, 'placeholder' => 'Votre nom', 'required' => true));?>
					<br>
					<?= $this->Form->input('commentaire', array('class' => 'form-control', 'label' => false, 'placeholder' => 'Avis', 'type' => 'textarea'));?>
					<br>
					<?php echo $this->Form->submit('Valider', array('div' => false,'class' => 'btn btn-primary')); ?>
					<?= $this->Form->end();?>

					<hr>
					<div class="commentaire well well-sm">
					<h4><strong>Jean</strong>,<i> <small>le 19 Janvier 2014 à 20h43</small></i></h4> <!-- nom de l'utilisateur et la date du commentaire -->
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, deleniti, nemo eos quae ad et suscipit porro optio enim pariatur ipsa sequi quaerat perferendis sunt est officia debitis dignissimos consectetur!</p> <!-- commentaire -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>