<?php

/* Hugo, tu px mettre du style sur les Sesssion->setFlash stp :) */

App::uses('AppController', 'Controller');


class PaniersController extends AppController {

	public $uses = array('Chaussure','Stock','Souscategorie','User','Marque');

    public function beforeFilter() 
    {
 		//$action = $this->request->params['action'];
        parent::beforeFilter();
        $this->Auth->allow();
    }
 
	public function index() {
		/* La liste du contenu du panier */
		if($this->Session->check('User.Panier')) // Si l'user a mis des produits dans son panier
		{
			/* Je check l'array de la session Panier, pour savoir le nombre d'entree,
				car dans le cas ou l'user supprime le dernier item de son panier,
				il n'a pas le message : Votre panier est vide. Donc pour palier a ce cas,
				je compte le nombre d'entree dans l'array Panier : si il est a 0, cela
				veut dire qu'il a supprime le dernier item. 
				Et ds ce cas la, je supprime son array Panier, histoire de rentrer ds le else
				de la condition de Hugo ds la vue. */
			if(count($this->Session->read('User.Panier')) == 0)
			{
				$this->Session->delete('User.Panier'); 

				return $this->redirect(array('controller' => 'paniers', 'action' => 'index'));
			}
			$panier = $this->Session->read('User.Panier');
			$prixtotal = 0;
			$nbr_article = 0;
			foreach($panier as $product) // Calcul du nombre d'arcticle ainsi que du prix total
			{
				$prixtotal += $product['prix']*$product['quantity'];
				$nbr_article += $product['quantity'];
			}
			$this->set('total', $prixtotal);
			$this->set('nbr_article', $nbr_article);
			$this->set('products', $panier);
		}
		// else // Si y'a rien dans sa Session panier
		// {
				/* Si on veut passer des variables a la vue (dernieres shoes consultees etc...) */
		// }
	}

	public function addToPanier() {
		// $this->Session->destroy(); die();
		if($this->Session->check('User.Panier'))
		{
			/* Si la session User.Panier existe c'est qu'il a deja mis qq chose ds son panier au cours 
				de cette session, donc je passe direct ici pour pas recreer (et donc vider)
				l'array panier. 
			*/
			$ref = $this->request->params['pass'];
			$find = $this->Chaussure->find('first', array(
				'conditions' => array('Chaussure.ref' => $ref)
				)
			);
			$pointure = $this->request->data['Panier']['pointure'];
			$quantity = $this->request->data['Panier']['quantity'];
			$find['Chaussure']['pointure'] = $pointure;
			$find['Chaussure']['quantity'] = $quantity;
			$panier = $this->Session->read('User.Panier');
			$trouve=false;
			$cpt=0;
			$id=0;
			foreach($panier as $product)
			{
				if($find['Chaussure']['nom'] == $product['nom'] && $product['pointure'] == $find['Chaussure']['pointure'])
				{
					/* Si la chaussure que l'user essaye d'ajouter est deja dans le panier avec la meme pointure
						qu'il demande, je set trouve a true */
					$trouve=true;
					$id=$cpt;
				}
				$cpt++;
			}
			if(!$trouve)
			{
				/* Si trouve est false, la chaussure que l'user veut rajouter est completement nouvelle
					dans le panier, donc je fais simplement un array_push de la chaussure ds le panier */
				array_push($panier, $find['Chaussure']);
			}
			else
			{
				/* Sinon j'overwrite la quantitee de la chaussure en ajoutant 
					l'ancienne quantitee + la nouvelle */
				$panier[$id]['quantity']+=$find['Chaussure']['quantity'];
			}

			$this->Session->write('User.Panier', $panier);

			if($quantity > 1)
				$this->Session->setFlash('La chaussure ' . $find['Chaussure']['nom'] . '(de pointure : ' . $pointure . ')' . ' a étée ajoutée à votre 
					<a href="'. Router::url('/') .'paniers/">panier</a> pour une quantitée de ' . $quantity . ' exemplaires.');
			else
				$this->Session->setFlash('La chaussure ' . $find['Chaussure']['nom'] . '(de pointure : ' . $pointure . ')' . ' a étée ajoutée à votre
				 <a href="'. Router::url('/') .'paniers/">panier</a>.');

			return $this->redirect('/chaussures/produit/' . $ref[0]);
		}

		/* La c'est le cas ou la session panier est vide (premier ajout d'un article au panier, en somme) */
		$ref = $this->request->params['pass'];
		$find = $this->Chaussure->find('first', array(
				'conditions' => array('Chaussure.ref' => $ref)
			)
		);
		$pointure = $this->request->data['Panier']['pointure'];
		$quantity = $this->request->data['Panier']['quantity'];
		$find['Chaussure']['pointure'] = $pointure;
		$find['Chaussure']['quantity'] = $quantity;
		$panier = array();
		array_push($panier, $find['Chaussure']);
		$this->Session->write('User.Panier', $panier);
		
		if($quantity > 1)
			$this->Session->setFlash('La chaussure ' . $find['Chaussure']['nom'] . '(de pointure : ' . $pointure . ')' . ' a étée ajoutée à 
				votre <a href="'. Router::url('/') .'paniers/">panier</a> pour une quantitée de ' . $quantity . ' exemplaires.');
		else
			$this->Session->setFlash('La chaussure ' . $find['Chaussure']['nom'] . '(de pointure : ' . $pointure . ')' . ' a étée ajoutée à
			 votre <a href="'. Router::url('/') .'paniers/">panier</a>.');

			return $this->redirect('/chaussures/produit/' . $ref[0]);
	}

	public function quantityUp()
	{
		$index = $this->request->params['pass'];
		$i = $index[0];
		
		$panier = $this->Session->read('User.Panier');
		$nom_produit = $panier[$i]['nom'];
		$quantity_produit = $panier[$i]['quantity'];
		$case = 0; // Je me sers de ca juste pour le message setflash a la fin !

		foreach($panier as $key=>$product)
		{
			if($product['nom'] == $nom_produit && $product['quantity'] == $quantity_produit)
			{
				if($quantity_produit > 5)
				{
					$case = 1;
					break;
				}
				else
				{
					$panier[$key]['quantity'] = $product['quantity']+1;
					$case = 2;
				}
			}			
		}
		$this->Session->write('User.Panier', $panier);
		if($case == 1)
			$this->Session->setFlash("SVP Merci de pas acheter des chaussures pour toute l'afrique...");

		return $this->redirect($this->referer());
		// return $this->redirect(array('controller' => 'paniers', 'action' => 'index'));				
	}

	public function quantityDown()
	{
		$index = $this->request->params['pass'];
		$i = $index[0];
		
		$panier = $this->Session->read('User.Panier');
		$nom_produit = $panier[$i]['nom'];
		$quantity_produit = $panier[$i]['quantity'];

		foreach($panier as $key=>$product)
		{
			if($product['nom'] == $nom_produit && $product['quantity'] == $quantity_produit)
			{
				$panier[$key]['quantity'] = $product['quantity']-1;
				$case = 1;
				if($panier[$key]['quantity'] == 0)
				{
					unset($panier[$key]);
					$case = 2;
				}
			}			
		}
		$this->Session->write('User.Panier', $panier);

		if($case == 2)
			$this->Session->setFlash("Votre produit a correment ete supprime.");	
		
		return $this->redirect($this->referer());
		// return $this->redirect(array('controller' => 'paniers', 'action' => 'index'));
	}

	public function deleteFromPanier()
	{
		$index = $this->request->params['pass'];
		$i = $index[0];
		$panier = $this->Session->read('User.Panier');
		unset($panier[$i]); // J'unset l'item passer en parametre du panier
		$panier = array_values($panier); /* Je reindex les values de l'array */
		
		$this->Session->write('User.Panier', $panier); // Je reecris la session pour changer le contenu de la vue

		return $this->redirect($this->referer());
		// return $this->redirect(array('controller' => 'paniers', 'action' => 'index'));
	}

	public function viderPanier()
	{
		$this->Session->delete('User.Panier');
		return $this->redirect(array('controller' => 'paniers', 'action' => 'index'));
	}

	public function checkout() {
		if(!$this->Session->check('User.Panier'))
		{
			$this->redirect(array('controller' => 'paniers', 'action' => 'index'));
		}
		$panier = $this->Session->read('User.Panier');
		$prixtotal = 0;
		$nbr_article = 0;
		foreach($panier as $product) // Calcul du nombre d'arcticle ainsi que du prix total
		{
			$prixtotal += $product['prix']*$product['quantity'];
			$nbr_article += $product['quantity'];
		}
		$this->set('total', $prixtotal);
		$this->set('nbr_article', $nbr_article);
		$this->set('products', $panier);
	}
}
