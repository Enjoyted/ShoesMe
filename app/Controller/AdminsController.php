<?php

class AdminsController extends AppController {


	public $uses = array('Chaussure','Stock','Souscategorie','User','Marque','Fournisseur','Commande');

// A enlever quand le systeme des droits sera en place

	public function beforeFilter()
	{

		parent::beforeFilter();

		if($this->Auth->user('rank') == 1){
		$this->Auth->allow('index','addsouscategorie','deleteuser','addmarque');
		}
		else{
		return $this->redirect('/');
		}
				

	}

// Affichage correct lors de la recherche , plus de doublon 

	public function index(){

		$this->set('souscategories', $this->Souscategorie->find('all'));
		$this->set('users', $this->User->find('all'));
		$this->set('marques', $this->Marque->find('all'));
		$this->set('commandes', $this->Commande->find('all' , array(
				'conditions' => array('Commande.status' => "en cours"))));
		
		$users_cmd = $this->User->find('all');

		$this->set('all_chaussures', $this->Chaussure->find('all'));


		$this->set('users_cmd' , $users_cmd);

			$optionsbtn = array(
			'label' => 'Definir comme livré',
			'a' => array(
				'class' => 'btn btn-sm btn-primary',
				)
			);

		$this->set('optionsbtn' , $optionsbtn);


		$select_souscat = $this->Souscategorie->find('list' , array(
			'fields' => array('Souscategorie.nom')));

		$this->set('select_souscat' , $select_souscat);


		$select_marque = $this->Marque->find('list' , array(
			'fields' => array('Marque.nom')));

		$this->set('select_marque' , $select_marque);

		if($this->request->is('post')) {
			$ref = $this->request->data['Chaussure']['ref'];
			$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.ref LIKE' => "$ref")
			)));
		}
		
		}

// Ajout catégorie OK

	public function addsouscategorie()
	{
		if($this->request->is('post')) {
			if($this->Souscategorie->save($this->request->data['Admin']))
			{
				return $this->redirect('/admin');
			}
		}
	}

	public function addmarque()
	{
		if($this->request->is('post')) {

			
			if($this->Marque->save($this->request->data['Marque']))
			{
				$id_marque = $this->Marque->find('first', array(
					'order' => array('Marque.id' => 'desc')
					));
				$this->request->data['Fournisseur']['marque_id'] = $id_marque['Marque']['id'];
			}
			if ($this->Fournisseur->save($this->request->data['Fournisseur'])) {
				
				$id_fournisseur = $this->Fournisseur->find('first', array(
					'order' => array('Fournisseur.id' => 'desc')
					));

				$id_fournisseur_int = $id_fournisseur['Fournisseur']['id'];

				$this->Marque->updateAll(
					array('Marque.fournisseur_id' => $id_fournisseur_int),
					array('Marque.id' => $id_marque['Marque']['id'])
					);

				return $this->redirect('/admin');
			}
		}
	}

// Delete user OK , jointure avec les commentaires a faire plus tard

	public function deleteuser(){
		if($this->request->is('post')) {
			$id = $this->request->data['User']['id'];

			if($this->User->delete($id)) {
				echo 'Utilisateur supprimée avec succes';
				return $this->redirect('/admin');
			}
			else
			{
				echo 'ko';
			}
		}
	}

	public function BeAdmin(){
		if($this->request->is('post')) {
			
			$id = $this->request->data['User']['id'];

			 $this->User->set(array(
                'id' => $id,
                'rank' => 1,
                ));
            $this->User->save();
            return $this->redirect('/admin');
		}

	}

}