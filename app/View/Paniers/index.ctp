<ol class="breadcrumb">
	<li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
	<li class="active">Panier</li>
</ol>

<?php if($this->Session->check('User.Panier')){?>

<h2 style="display:inline-block">Votre Panier</h2>
<br>
<h4 class='pull-right'> <a href="<?php echo Router::url('/') ?>paniers/viderPanier">Vider votre panier</a> </h4>
<br>
</div>
<br> <br>
<div class="row">
	<div class="col-sm-12 col-md-12">
		<div class="cart-info">
			<?php foreach($products as $value => $product) { ?>
			<table class="table">
				<thead>
					<tr>
						<th>Image</th>
						<th>Produit</th>
						<th>Pointure</th>
						<th>Prix</th>
						<th>Quantité</th>
						<th>Supprimer</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center">
								<img class='img-panier' src="<?php echo $this->webroot.'/img/Chaussures/' . $product['path'];?>"/>
							</td> <!-- image du produit -->
							<td class="nom_produit"><a href=""><?php echo $product['nom']; ?></a></td> <!-- nom du produit avec lien vers la page du produit -->
							<td><?php echo $product['pointure']; ?></td>
							<td><?php echo $product['prix'] ?> €</td>
							<td class="quantity">
								<a href="<?php echo Router::url('/'); ?>paniers/quantityDown/<?php echo $value; ?>">
									<span class="glyphicon glyphicon-minus"> </span>
								</a>
								<span> <?php echo $product['quantity']; ?> </span>
								<a href="<?php echo Router::url('/'); ?>paniers/quantityUp/<?php echo $value; ?>">
									<span class="glyphicon glyphicon-plus"> </span>
								</a>
							</td>
							<td class="supprimer">
								<a href="<?php echo Router::url('/'); ?>paniers/deleteFromPanier/<?php echo $value; ?>">
									<span class='glyphicon glyphicon-remove-sign'></span>
								</a>
							</td>
							<td class="total"><?php echo $product['prix'] * $product['quantity']; ?> €</td>
						</tr>
					</tbody>									
				</table>
				<?php } ?>
			</div> 			

			<hr>				
			<br>
			<h3>Total du panier</h3>
			<br>
			<div class="cart-totals">
				<table class="table">
					<tbody><tr>
						<th>Nbr Produits</th>
						<td><?php echo $nbr_article; ?></td>
					</tr>
					<tr>
						<th>Livraison</th>
						<td>Livraison 100% gratuite</td>
					</tr>
					<tr>
						<th><span>Total commande</span></th>
						<td><?php echo $total; ?> €</td>
					</tr>					
				</tbody></table>
				<p class='text-right'>
					<a class="btn btn-primary" href="<?php echo Router::url('/') ?>paniers/checkout">
						Commander <small>(Paiement 100% sécurisé)</small>
					</a>
				</p>
			</div>

			<br>

			<?php } 
			else 
				{?>

			<h2 class='text-center'>Oops, mais votre panier est vide !</h2>

			<br>
			<p class='text-center'>
				<a class="btn btn-primary" href="<?= Router::url('/') ?>">
					Commencez vos achats</small>
				</a>
			</p>

			<?php
		}
		?> 
		<br>

		<ol class="breadcrumb">
			<li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
			<li class="active">Panier</li>
		</ol>