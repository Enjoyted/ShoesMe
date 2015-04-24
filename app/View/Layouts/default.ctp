<!DOCTYPE html>
<html>
<head>
	<?php echo $this->fetch('meta');?>
	<?php echo $this->Html->charset(); ?>
	<title>ShoesMe</title>
	<?php
	echo $this->fetch('css');
	echo $this->Html->css(array('bootstrap', 'font-awesome.min', 'bootstrap-select.min', 'datepicker', 'slider', 'style','responsiveslides', 'yamm'));?>
</head>
<body>
	<div class="container"> <!-- start .container -->
		<div class="header">
			<div class="row">
				<div class="col-md-8">
					<?php echo $this->Html->image("logo.png", array(
						"alt" => "ShoesMe",
						'title' => 'ShoesMe',
						'url' => '/',
						'class' => 'img-responsive'
						));
						?>
					</div>
					<br>

					<div class="col-md-4 hidden-xs">
						<?php echo $this->form->create('Post', array('url' => '/app/search')); ?>
						<div class="input-group">

							<form method='POST' action='/../app/search'>
							<input type="text" class="form-control" name='data[Chaussure][nom]' value='' required placeholder="Entrez le nom d'une chaussure...">
							<span class="input-group-btn">
								<button class="btn btn-default" type='submit'>Rechercher</button>
							</span>

							<?= $this->Form->end()?>
							<!-- </form> -->
						</div>
					</div>
				</div>

				<div class="navbar yamm">
					<div id="navbar-collapse-2" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown yamm-fullwidth text-center">
								<a data-toggle="dropdown" class='dropdown-toggle disabled js-activated' href="<?php echo Router::url('/') ?>paniers">
									<span class="glyphicon glyphicon-shopping-cart"></span> 
									Mon panier 
									<?php 
									if($this->Session->check('User.Panier')) { echo '(' . $nbr_article . ')' ; } ?>
									<b class="caret hidden-xs"></b>
								</a>
								<ul class="dropdown-menu hidden-xs">
									<li>
										<div class="yamm-content">
											<?php if($this->Session->check('User.Panier')){?>
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
															<td class="nom_produit"><?= $product['nom']; ?></a></td> <!-- nom du produit avec lien vers la page du produit -->
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
																	<span class='glyphicon glyphicon-remove-sign'></span></a></td>
																	<td class="total"><?php echo $product['prix'] * $product['quantity']; ?> €</td>
																</tr>
															</tbody>									
														</table>
														<?php } ?>
													</div> 							

													<p class='text-right'>
														<a class="btn btn-sm btn-primary" href="<?php echo Router::url('/') ?>paniers">
															Voir mon panier
														</a>
													</p>

													<br>

													<?php }else{?>
													<strong class='text-center'>Oops, mais votre panier est vide !</strong>
													<?php
												}
												?> 
											</div>
										</li>

									</ul>
									<li class="dropdown text-center">
										<?php if ($this->Session->read('Auth.User.id')){?>
										<a href="<?php echo Router::url('/') ?>users" class='dropdown-toggle disabled js-activated' data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?= AuthComponent::user('prenom')?> <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><?= $this->Html->link('Mon profil',array('controller' => 'users','action' => 'index','full_base' => true));?></li>
											<li><?= $this->Html->link("Logout",array('controller' => 'users','action' => 'logout','full_base' => true));?></li>
										</ul>
										<?php }else{?>
										<a href="<?php echo Router::url('/') ?>users" class='dropdown-toggle disabled js-activated' data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Mon profil <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><?= $this->Html->link('Se connecter',array('controller' => 'users','action' => 'login','full_base' => true));?></li>
											<li><?= $this->Html->link("S'inscrire",array('controller' => 'users','action' => 'register','full_base' => true));?></li>
										</ul>
										<?php
									}
									?> 
								</li>
							</ul>
						</div>
						
					</div> <!-- fin header  -->

					<div class="navbar navbar-default text-center" role="navigation">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="<?= Router::url('/'); ?>"><span class="glyphicon glyphicon-home"></span></a>
							</div>
							<div class="navbar-collapse collapse navbar-center">
								<ul class="nav navbar-nav categories">
									<li class="dropdown homme">
										<a href="<?php echo Router::url('/') ?>femmes" class="dropdown-toggle disabled js-activated" data-toggle="dropdown">FEMME <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li class="dropdown-header">UNIVERS</li>
											<li class='divider'></li>
											<?php 
											foreach ($souscategories as $souscategorie) {
												?>
												<li><a href="<?php echo Router::url('/') ?>femmes/sub_category/<?php echo $souscategorie['Souscategorie']['id']; ?>"><?php echo $souscategorie['Souscategorie']['nom']; ?></a></li>
												<?php
											}
											?>
										</ul>
									</li>
									<li class="dropdown homme">
										<a href="<?php echo Router::url('/') ?>hommes" class="dropdown-toggle disabled js-activated" data-toggle="dropdown">HOMME <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li class="dropdown-header">UNIVERS</li>
											<li class='divider'></li>
											<?php 
											foreach ($souscategories as $souscategorie) {
												?>
												<li><a href="<?php echo Router::url('/') ?>hommes/sub_category/<?php echo $souscategorie['Souscategorie']['id']; ?>"><?php echo $souscategorie['Souscategorie']['nom']; ?></a></li>
												<?php
											}
											?>
										</ul>
									</li>
									<li class="dropdown enfant">
										<a href="<?php echo Router::url('/') ?>enfants" class="dropdown-toggle disabled js-activated" data-toggle="dropdown">ENFANT <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li class="dropdown-header">UNIVERS</li>
											<li class='divider'></li>
											<?php 
											foreach ($souscategories as $souscategorie) {
												?>
												<li><a href="<?php echo Router::url('/') ?>enfants/sub_category/<?php echo $souscategorie['Souscategorie']['id']; ?>"><?php echo $souscategorie['Souscategorie']['nom']; ?></a></li>
												<?php } ?>
											</ul>
										</li>
									</ul>
									<ul class="nav navbar-nav navbar-right">
										<?php 
										if($this->Session->read('Auth.User.rank') == 1){
											?>
											<li class='active'><?= $this->Html->link('Admin',array('controller' => 'admins','action' => 'index','full_base' => true));?></li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>

							<hr>


							<?php echo $this->Session->flash(); ?>
							<?php echo $this->fetch('content'); ?>

							<hr>

							<!-- FOOTER-->

							<div id='footer'>
								<!-- Start Newsletter -->
								<div class="newsletter">
									<div class="well">
										<div class="row">
											<div class="col-md-8">
												<p class="lead"><strong>Inscription à la Newsletter ShoesMe.</strong> </p>
												Avantages, offres et nouveautés en avant-première !
											</div>
											<div class="col-md-4"> 
												<?php echo $this->Html->link("S'ABONNER →", array('controller' => 'pages','action'=> 'home'), array( 'class' => 'btn btn-lg btn-default btn-block')); ?>
											</div>
										</div>
									</div>
								</div>
								<!-- Fin Newsletter -->

								<div class="panel panel-default">
									<div class="panel-body">
										<footer class="row" >
											<div class="col-md-3">
												<h4 class="line3 center standart-h4title"><span>Mon compte</span></h4>

												<ul class="footer-links">
													<li><?= $this->Html->link('Mon profil',array('controller' => 'users','action' => 'index','full_base' => true));?></li>
													<li><?= $this->Html->link('Mon historique de commandes',array('controller' => 'users','action' => 'historique','full_base' => true));?></li>
													<li><?= $this->Html->link('Mon panier',array('controller' => 'paniers','action' => 'index','full_base' => true));?></li>

												</ul>
											</div>
											<div class="col-md-3">
												<h4 class="line3 center standart-h4title"><span>Besoin d'aide ?</span></h4>

												<ul class="footer-links">
													<li><?= $this->Html->link('Contact',array('controller' => 'pages','action' => 'home','full_base' => true));?></li>
													<li><?= $this->Html->link('Suivre mes commandes',array('controller' => 'users','action' => 'historique','full_base' => true));?></li>
												</ul>
											</div>

											<div class="col-md-3">
												<h4 class="line3 center standart-h4title"><span>ShoesMe, c'est quoi ?</span></h4>
												
												<small>Livraison toujours gratuite</small><br>
												<small>100 jours pour renvoyer ou échanger</small><br>
												<small>Retour gratuit et prépayé</small><br>
												<small>Expédition express</small><br>
												<small>Meilleur prix sur Internet</small><br>

											</div>

											<div class="col-md-3">
												<h4 class="line3 center standart-h4title"><span>Nos cordonnés</span></h4>
												<address>
													<strong>shoesme.fr</strong><br>
													<small>Vente de chaussures en ligne.</small><br>
													<br>
													<i class="fa-icon-map-marker"></i> 14 bis avenue de Pigalle<br>
													75004 Paris<br>
													<i class="fa-icon-sm-sign"></i> + 33 01 01 20 20

												</address>

											</div>

										</footer>
									</div>
									<!-- /Footer-->
									<hr>
									<!-- PayPal Logo -->
									<table class="hidden-xs" border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/fr/webapps/mpp/paypal-popup" title="PayPal Comment Ca Marche" onclick="javascript:window.open('https://www.paypal.com/fr/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/logo-center/logo_paypal_paiements_securises_fr.jpg" border="0" alt="PayPal Acceptance Mark"></a></td></tr></table><!-- PayPal Logo -->
								</div>
							</div>
						</div>
					</div>
				</div><!-- end .container -->
				<div class="container">
					<div class='pull-right'>
						<p>© ShoesMe 2014</p>
						<small>by lopes_l, olivei_m, isidor_t</small>
					</div>
				</div>
				<?php echo $this->fetch('script');
				echo $this->Html->script(array('jquery', 'bootstrap.min', 'script', 'bootstrap-datepicker', 'responsiveslides.min', 'bootstrap-hover-dropdown.js', 'jquery.elevateZoom-3.0.8.min', 'slider')); ?> 
			</body>
			</html>
